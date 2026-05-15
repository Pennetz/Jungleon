<?php
require_once __DIR__ . '/auth_guard.php';
?>
<!doctype html>
<html lang="it">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Demo Login Google + ID Token (JWT) + Verifica firma (client)</title>
  <style>
    :root { color-scheme: light; }
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 24px; line-height: 1.35; }
    h1 { margin: 0 0 8px; font-size: 22px; }
    .muted { color: #555; }
    .row { display: grid; grid-template-columns: 1fr; gap: 14px; margin-top: 14px; }
    @media (min-width: 980px) { .row { grid-template-columns: 1fr 1fr; } }
    .card { border: 1px solid #ddd; border-radius: 12px; padding: 14px; background: #fafafa; }
    .card h2 { margin: 0 0 10px; font-size: 16px; }
    pre { margin: 0; padding: 12px; border-radius: 10px; background: #111; color: #eee; overflow: auto; max-height: 360px; }
    code { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace; font-size: 12px; }
    .badge { display: inline-flex; align-items: center; gap: 8px; padding: 8px 10px; border-radius: 999px; font-weight: 700; }
    .ok { background: #e6ffed; border: 1px solid #b7f5c6; color: #095c1f; }
    .ko { background: #ffecec; border: 1px solid #ffbcbc; color: #7a0b0b; }
    .checks { display: grid; grid-template-columns: 1fr; gap: 6px; margin-top: 10px; }
    .check { display: flex; justify-content: space-between; gap: 10px; padding: 8px 10px; border-radius: 10px; background: #fff; border: 1px solid #e6e6e6; }
    .check b { font-weight: 650; }
    .pill { padding: 2px 8px; border-radius: 999px; font-weight: 700; }
    .pill.ok { background: #e6ffed; border: 1px solid #b7f5c6; color: #095c1f; }
    .pill.ko { background: #ffecec; border: 1px solid #ffbcbc; color: #7a0b0b; }
    .top { display:flex; flex-wrap: wrap; align-items: center; gap: 12px; }
    .hint { font-size: 13px; }
    .small { font-size: 12px; }
    .warn { background: #fff7e6; border: 1px solid #ffe0a6; padding: 10px 12px; border-radius: 12px; }
  </style>

  <!-- Google Identity Services -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
  <h1>Login Google → ID Token (JWT) + Header/Payload/Signature + Verifica (client)</h1>
  <p class="muted">
    Questa pagina mostra: <b>header</b>, <b>payload</b>, <b>signature</b> dell’ID token e (solo a scopo didattico)
    verifica firma RS256 tramite chiavi pubbliche Google + check <code>iss</code>, <code>exp</code>, <code>aud</code>.
  </p>

  <div class="warn hint">
    Nota: la verifica firma in browser richiede <b>https</b> o <b>http://localhost</b> (WebCrypto). In produzione, la
    validazione “che conta” va fatta lato server.
  </div>

  <div class="top" style="margin-top: 14px;">

    <div id="g_id_onload"
         data-client_id="373334294352-9272k7p8reuhpfsk0ni3a82ak155mj5s.apps.googleusercontent.com"
         data-callback="handleCredentialResponse">
    </div>

    <div class="g_id_signin" data-type="standard"></div>

    <span id="overallBadge" class="badge ko" title="In attesa di login…">⏳ In attesa di login</span>
  </div>

  <div class="row">
    <div class="card">
      <h2>Esito verifiche</h2>
      <div class="checks" id="checks"></div>
      <p class="small muted" id="expHuman"></p>
      <p class="small muted" id="sigErr"></p>
    </div>

    <div class="card">
      <h2>JWT (raw)</h2>
      <pre><code id="jwtRaw">(non ancora disponibile)</code></pre>
    </div>

    <div class="card">
      <h2>JWT Header (JSON)</h2>
      <pre><code id="jwtHeader">{}</code></pre>
    </div>

    <div class="card">
      <h2>JWT Payload (JSON)</h2>
      <pre><code id="jwtPayload">{}</code></pre>
    </div>

    <div class="card" style="grid-column: 1 / -1;">
      <h2>JWT Signature (base64url)</h2>
      <pre><code id="jwtSignature">(signature)</code></pre>
    </div>

    <div class="card">
      <h2>Immagine profilo</h2>
      <img src="" alt="immagine profilo" id="profilePicture"><!-- style="border-radius: 50%; max-width: 120px; display: none;" -->

    </div>
  </div>

  <script>
    // ====== ENTRYPOINT (callback Google) ======
    async function handleCredentialResponse(response) {
      const idToken = response.credential;
      renderJwtParts(idToken);

      // Audience attesa: leggiamo il client_id dalla configurazione GIS in pagina
      const expectedAudience = document.getElementById("g_id_onload")?.dataset?.client_id;

      const result = await verifyGoogleIdToken(idToken, expectedAudience);
      renderVerification(result, expectedAudience);
    }

    // ====== RENDER: mostra header/payload/signature/raw ======
    function renderJwtParts(idToken) {
      const [h, p, s] = idToken.split(".");
      const header = safeDecodeJson(h);
      const payload = safeDecodeJson(p);

      document.getElementById("jwtRaw").textContent = idToken;
      document.getElementById("jwtHeader").textContent = JSON.stringify(header, null, 2);
      document.getElementById("jwtPayload").textContent = JSON.stringify(payload, null, 2);
      document.getElementById("jwtSignature").textContent = s || "(mancante)";
      document.getElementById("profilePicture").src = payload.picture || "";
    }

    function safeDecodeJson(part) {
      try { return decodeBase64UrlJson(part); }
      catch { return { error: "Impossibile decodificare JSON" }; }
    }

    // ====== VERIFY: firma RS256 + iss/exp/aud ======
    async function verifyGoogleIdToken(idToken, expectedAudience) {
      const [hB64u, pB64u, sB64u] = idToken.split(".");
      if (!hB64u || !pB64u || !sB64u) {
        return { ok: false, reason: "JWT non valido (parti != 3)" };
      }

      const header = decodeBase64UrlJson(hB64u);
      const payload = decodeBase64UrlJson(pB64u);

      const nowSec = Math.floor(Date.now() / 1000);

      const checks = {
        algIsRS256: header.alg === "RS256",
        hasKid: typeof header.kid === "string" && header.kid.length > 0,

        // Google accetta entrambi come issuer negli ID token
        issOk:
          payload.iss === "https://accounts.google.com" ||
          payload.iss === "accounts.google.com",

        expPresent: typeof payload.exp === "number",
        expNotExpired: typeof payload.exp === "number" && payload.exp > nowSec,

        audPresent: typeof payload.aud === "string" || Array.isArray(payload.aud),
        audMatches:
          expectedAudience
            ? (Array.isArray(payload.aud)
                ? payload.aud.includes(expectedAudience)
                : payload.aud === expectedAudience)
            : false
      };

      let signatureOk = false;
      let signatureError = null;

      try {
        if (!checks.algIsRS256) throw new Error(`alg non supportato: ${header.alg}`);
        if (!checks.hasKid) throw new Error("kid mancante: impossibile scegliere la chiave pubblica");

        // JWKS Google (chiavi pubbliche)
        const jwksUrl = "https://www.googleapis.com/oauth2/v3/certs";
        const jwks = await fetch(jwksUrl).then(r => {
          if (!r.ok) throw new Error(`Errore fetch JWKS: ${r.status}`);
          return r.json();
        });

        const jwk = (jwks.keys || []).find(k => k.kid === header.kid);
        if (!jwk) throw new Error(`Chiave non trovata per kid=${header.kid} (rotazione chiavi?)`);

        const publicKey = await crypto.subtle.importKey(
          "jwk",
          jwk,
          { name: "RSASSA-PKCS1-v1_5", hash: "SHA-256" },
          false,
          ["verify"]
        );

        const signedData = new TextEncoder().encode(`${hB64u}.${pB64u}`);
        const signatureBytes = base64UrlToBytes(sB64u);

        signatureOk = await crypto.subtle.verify(
          { name: "RSASSA-PKCS1-v1_5" },
          publicKey,
          signatureBytes,
          signedData
        );
      } catch (e) {
        signatureError = e?.message ?? String(e);
      }

      checks.signatureOk = signatureOk;

      // OK complessivo: firma + iss + exp + aud
      const ok =
        checks.signatureOk &&
        checks.issOk &&
        checks.expPresent &&
        checks.expNotExpired &&
        checks.audPresent &&
        checks.audMatches;

      return { ok, checks, header, payload, signatureError };
    }

    // ====== RENDER: badge + lista check ======
    function renderVerification(result, expectedAudience) {
      const badge = document.getElementById("overallBadge");
      const checksEl = document.getElementById("checks");
      const expHumanEl = document.getElementById("expHuman");
      const sigErrEl = document.getElementById("sigErr");

      if (!result || result.reason) {
        badge.className = "badge ko";
        badge.textContent = "❌ Token non valido";
        checksEl.innerHTML = `<div class="check"><b>Errore</b><span class="pill ko">${escapeHtml(result?.reason || "sconosciuto")}</span></div>`;
        return;
      }

      badge.className = "badge " + (result.ok ? "ok" : "ko");
      badge.textContent = result.ok ? "✅ Verifica OK (demo)" : "❌ Verifica KO (demo)";

      const map = [
        ["signatureOk", "Firma RS256 valida"],
        ["issOk", "Issuer (iss) valido"],
        ["expNotExpired", "Token non scaduto (exp)"],
        ["audMatches", "Audience (aud) = client_id"]
      ];

      const lines = map.map(([k, label]) => {
        const ok = !!result.checks[k];
        return `
          <div class="check">
            <b>${label}</b>
            <span class="pill ${ok ? "ok" : "ko"}">${ok ? "OK" : "KO"}</span>
          </div>`;
      }).join("");

      // extra info utili in classe
      const audInfo = expectedAudience ? `client_id atteso: ${expectedAudience}` : "client_id atteso: (mancante)";
      const issInfo = result.payload?.iss ? `iss: ${result.payload.iss}` : "iss: (mancante)";
      const expInfo = typeof result.payload?.exp === "number" ? `exp: ${result.payload.exp}` : "exp: (mancante)";
      const kidInfo = result.header?.kid ? `kid: ${result.header.kid}` : "kid: (mancante)";

      checksEl.innerHTML = lines + `
        <div class="check"><b>Dettagli</b><span class="pill ok">${escapeHtml(kidInfo)}</span></div>
        <div class="check"><b>Dettagli</b><span class="pill ok">${escapeHtml(issInfo)}</span></div>
        <div class="check"><b>Dettagli</b><span class="pill ok">${escapeHtml(expInfo)}</span></div>
        <div class="check"><b>Dettagli</b><span class="pill ok">${escapeHtml(audInfo)}</span></div>
      `;

      // scadenza leggibile
      if (typeof result.payload?.exp === "number") {
        const expMs = result.payload.exp * 1000;
        expHumanEl.textContent = "Scadenza (exp) in data/ora locale: " + new Date(expMs).toLocaleString();
      } else {
        expHumanEl.textContent = "";
      }

      // eventuale errore firma
      sigErrEl.textContent = result.signatureError ? ("Errore verifica firma: " + result.signatureError) : "";
    }

    // ====== HELPERS: base64url decode ======
    function decodeBase64UrlJson(base64Url) {
      const base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
      const padded = base64 + "===".slice((base64.length + 3) % 4);

      const binary = atob(padded);
      const bytes = Uint8Array.from(binary, c => c.charCodeAt(0));
      const jsonText = new TextDecoder("utf-8").decode(bytes);

      return JSON.parse(jsonText);
    }

    function base64UrlToBytes(base64Url) {
      const base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
      const padded = base64 + "===".slice((base64.length + 3) % 4);

      const binary = atob(padded);
      return Uint8Array.from(binary, c => c.charCodeAt(0));
    }

    function escapeHtml(s) {
      return String(s).replace(/[&<>"']/g, m => ({
        "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"
      }[m]));
    }
  </script>
</body>
</html>