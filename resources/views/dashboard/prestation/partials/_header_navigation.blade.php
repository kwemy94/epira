@php
    $tabs = [];

    if (in_array($active, ['consultation', 'ambulatoire', 'visite'])) {
        $tabs = [
            'acte' => 'Actes médicaux',
            'traitement' => 'Traitements',
            'ordonnances' => 'Ordonnances',
            'examens' => 'Examens demandés',
            'documents' => 'Documents',
            'honoraires' => 'Honoraires',
            'facturation' => 'Facturation',
            'teletransmission' => 'Télétransmission',
            'paiement' => 'Paiement',
        ];
    }

    if ($active === 'hospitalisation') {
        $tabs = [
            'acte' => 'Actes médicaux',
            'traitement' => 'Traitements',
            'ordonnances' => 'Ordonnances',
            'chambre' => 'Chambre',
            'examens' => 'Examens demandés',
            'documents' => 'Documents',
            'honoraires' => 'Honoraires',
            'facturation' => 'Facturation',
            'teletransmission' => 'Télétransmission',
            'paiement' => 'Paiement',
        ];
    }

    if ($active === 'devis') {
        $tabs = [
            'acte' => 'Actes médicaux',
            'teletransmission' => 'Télétransmission',
            'reponses' => 'Réponses',
        ];
    }

    if (in_array($active, ['pharmacie'])) {
        $tabs = [
            'medicaments' => 'Médicaments',
            'documents' => 'Documents',
            'honoraires' => 'Honoraires',
            'facturation' => 'Facturation',
            'teletransmission' => 'Télétransmission',
            'paiement' => 'Paiement',
        ];
    }

    if (in_array($active, ['analyse', 'imagerie'])) {
        $tabs = [
            'acte' => 'Actes médicaux',
            'traitement' => 'Traitements',
            'documents' => 'Documents',
            'honoraires' => 'Honoraires',
            'facturation' => 'Facturation',
            'teletransmission' => 'Télétransmission',
            'paiement' => 'Paiement',
        ];
    }
@endphp


<ul class="nav nav-tabs bg-white px-3 pt-2" id="menuTabs">
    @foreach ($tabs as $target => $label)
        <li class="nav-item">
            <a class="nav-link {{ $target == 'facturation' ? 'active' : '' }}" data-target="#{{ $target }}">
                {{ $label }}
            </a>
        </li>
    @endforeach
</ul>
