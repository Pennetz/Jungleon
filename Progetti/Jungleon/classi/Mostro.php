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
}