<?php

class Mostro
{
    public string $nome;
    public int $livello;
    public ?string $Utenti;
    public ?string $descrizione;
    public int $esperienzaData;
    public int $oroDato;
    public int $vita;
    public int $resistenza;
    public int $velocita;
    public int $forza;
    public int $pubblico;
    public array $tipiMostri;
    public array $oggettiUtente;
    public array $oggettiPubblici;

    // TODO: le seguenti proprietà dovranno essere implementate in futuro
    // come attributi del mostro (armi, armature, effetti attivi).
    // Per ora vengono lasciate come commento per futura implementazione.
    // TODO: implementare come proprietà effettive in futuro
    // public array $armi = []; // esempio: ['mano' => ['danno'=>5,'modificatore'=>0.2], ...]
    // public array $armature = []; // esempio: [['assorbimento_percent'=>0.2,'assorbimento_flat'=>3], ...]
    // public array $effetti = []; // esempio: [['moltiplicatore'=>1.5,'flat'=>2], ...]

    public function __construct(
        string $nome,
        int $livello,
        ?string $Utenti,
        ?string $descrizione,
        int $esperienzaData,
        int $oroDato,
        int $vita,
        int $resistenza,
        int $velocita,
        int $forza,
        int $pubblico = 0,
        array $tipiMostri = [],
        array $oggettiUtente = [],
        array $oggettiPubblici = []
    ) {
        $this->nome = $nome;
        $this->livello = $livello;
        $this->Utenti = $Utenti;
        $this->descrizione = $descrizione;
        $this->esperienzaData = $esperienzaData;
        $this->oroDato = $oroDato;
        $this->vita = $vita;
        $this->resistenza = $resistenza;
        $this->velocita = $velocita;
        $this->forza = $forza;
        $this->pubblico = $pubblico;
        $this->tipiMostri = $tipiMostri;
        $this->oggettiUtente = $oggettiUtente;
        $this->oggettiPubblici = $oggettiPubblici;
    }

    public static function fromRequest(object $data): self
    {
        $tipiMostri = isset($data->tipiMostri) && is_array($data->tipiMostri) ? $data->tipiMostri : [];
        $oggettiUtente = isset($data->oggettiUtente) && is_array($data->oggettiUtente) ? $data->oggettiUtente : [];
        $oggettiPubblici = isset($data->oggettiPubblici) && is_array($data->oggettiPubblici) ? $data->oggettiPubblici : [];
        $velocita = $data->velocita ?? ($data->{"velocità"} ?? 0);

        return new self(
            $data->nome,
            $data->livello,
            $data->Utenti ?? null,
            $data->descrizione ?? null,
            $data->esperienzaData,
            $data->oroDato,
            $data->vita,
            $data->resistenza,
            $velocita,
            $data->forza,
            $data->pubblico ?? 0,
            $tipiMostri,
            $oggettiUtente,
            $oggettiPubblici
        );
    }

    public function toDbValues(): array
    {
        return [
            $this->nome,
            $this->livello,
            $this->Utenti,
            $this->descrizione,
            $this->esperienzaData,
            $this->oroDato,
            $this->vita,
            $this->resistenza,
            $this->velocita,
            $this->forza,
            $this->pubblico,
        ];
    }

    /**
     * Calcola il danno inflitto dal mostro.
     *
     * Parametri attesi:
     * - $arma: array opzionale con chiavi possibili:
     *     - 'danno' (int) : danno piatto aggiunto dall'arma
     *     - 'modificatore' (float) : moltiplicatore applicato al danno base (es. 0.2 per +20%)
     * - $effetti: array di effetti; ogni effetto può essere un array con:
     *     - 'moltiplicatore' (float) : moltiplica il danno (es. 1.5)
     *     - 'flat' (int) : aggiunge danno piatto
     * - $dannoBase: se passato, usa questo valore come danno base invece della forza del mostro
     *
     * Restituisce un intero >= 0.
     */
    public function calcolaDanno(?array $arma = null, array $effetti = [], ?int $dannoBase = null): int
    {
        // Danno base: oppure usa la forza del mostro se non specificato
        $base = $dannoBase ?? max(1, (int) round($this->forza));

        // Parametri arma: supportiamo danno piatto e modificatore percentuale
        $armaFlat = 0;
        $armaMult = 1.0;
        // TODO: in futuro usare l'arma equipaggiata come $this->armi[...]
        // Esempio: se non viene passato $arma alla funzione, prendere
        // l'arma equipaggiata dal mostro: $this->armi['main'] (da implementare)
        if ($arma !== null) {
            if (isset($arma['danno'])) {
                $armaFlat += (int) $arma['danno'];
            }
            if (isset($arma['modificatore'])) {
                // interpretato come valore da sommare al moltiplicatore base (es. 0.2 = +20%)
                $armaMult += (float) $arma['modificatore'];
            }
        }

        // Seleziona la parte casuale: uno dei moltiplicatori predefiniti
        $multiplicatori = [0, 0.25, 0.5, 0.75, 1, 1.25, 1.5, 1.75, 2];
        $idx = random_int(0, count($multiplicatori) - 1);
        $casuale = $multiplicatori[$idx];

        // Calcolo preliminare
        $danno = ($base * $armaMult + $armaFlat) * $casuale;

        // Applica effetti (moltiplicativi e piatti)
        // TODO: in futuro unire gli effetti passati come parametro con
        // gli effetti attivi del mostro (es. $this->effetti) prima di applicarli.
        // Esempio: $effettiTotali = array_merge($this->effetti, $effetti);
        foreach ($effetti as $eff) {
            if (!is_array($eff)) {
                continue;
            }
            if (isset($eff['moltiplicatore'])) {
                $danno *= (float) $eff['moltiplicatore'];
            }
            if (isset($eff['flat'])) {
                $danno += (int) $eff['flat'];
            }
        }

        return max(0, (int) round($danno));
    }

    /**
     * Calcola il danno effettivamente subito dal mostro.
     *
     * Parametri attesi:
     * - $dannoIn: danno in ingresso (già calcolato dal mittente)
     * - $velocitaAttaccante: velocità dell'attaccante (opzionale)
     * - $armature: array di pezzi di armatura; ogni pezzo può avere:
     *     - 'assorbimento_percent' (float) : valore 0.0-1.0 che riduce percentualmente il danno
     *     - 'assorbimento_flat' (int) : valore piatto sottratto al danno
     *
     * La funzione combina resistenza, armature e differenza di velocità per
     * restituire il danno finale (int >= 0).
     */
    public function calcolaDannoSubito(int $dannoIn, ?int $velocitaAttaccante = null, array $armature = []): int
    {
        // Resistenza del mostro interpretata come percentuale (es. 25 => 25%)
        $resPercent = max(0, min(0.9, $this->resistenza / 100)); // cap al 90%

        // Sommiamo gli effetti delle armature
        $armorPercent = 0.0;
        $armorFlat = 0;
        // TODO: in futuro non passare $armature come parametro ma usare
        // l'array delle armature equipaggiate dal mostro: $this->armature
        foreach ($armature as $p) {
            if (!is_array($p)) {
                continue;
            }
            if (isset($p['assorbimento_percent'])) {
                $armorPercent += (float) $p['assorbimento_percent'];
            }
            if (isset($p['assorbimento_flat'])) {
                $armorFlat += (int) $p['assorbimento_flat'];
            }
        }
        $armorPercent = max(0, min(0.9, $armorPercent)); // cap al 90%

        // Effetto della velocità: se il mostro è più veloce dell'attaccante riduce un po' il danno
        $dodgeFactor = 0.0;
        if ($velocitaAttaccante !== null) {
            $diff = $this->velocita - $velocitaAttaccante;
            // Normalizziamo la differenza per ottenere un impatto moderato (clamp tra -0.25 e 0.25)
            $dodgeFactor = max(-0.25, min(0.25, $diff / 200));
        }

        // Applichiamo le riduzioni: resistenza e armature moltiplicative, poi sottrazione piatta
        // TODO: applicare anche eventuali effetti difensivi attivi in $this->effetti
        // (es. scudo che blocca percentualmente o flat) prima di restituire il danno finale.
        $danno = $dannoIn;
        $danno *= (1 - $resPercent);
        $danno *= (1 - $armorPercent);
        $danno *= (1 - $dodgeFactor);
        $danno -= $armorFlat;

        return max(0, (int) round($danno));
    }
}