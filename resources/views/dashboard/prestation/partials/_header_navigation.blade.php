@php
    $tabs = [];

    if (in_array(Str::lower($active), ['consultation', 'ambulatoire', 'visite'])) {
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

    if (Str::lower($active) === 'hospitalisation') {
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

    if (Str::lower($active) === 'devis') {
        $tabs = [
            'acte' => 'Actes médicaux',
            'teletransmission' => 'Télétransmission',
            'reponses' => 'Réponses',
        ];
    }

    if (in_array(Str::lower($active), ['pharmacie'])) {
        $tabs = [
            'medicaments' => 'Médicaments',
            'documents' => 'Documents',
            'honoraires' => 'Honoraires',
            'facturation' => 'Facturation',
            'teletransmission' => 'Télétransmission',
            'paiement' => 'Paiement',
        ];
    }

    if (in_array(Str::lower($active), ['analyse', 'imagerie'])) {
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

{{-- @dd($devis); --}}
<ul class="nav nav-tabs bg-white px-3 pt-2" id="menuTabs">
    @foreach ($tabs as $target => $label)
        @php
            $isActive = false;
            if (in_array($target, ['facturation', 'reponses'])) {
                $isActive = true;
            }
        @endphp
        <li class="nav-item">
            {{-- <a class="nav-link {{ $isActive ? 'active' : '' }}" data-target="#{{ $target }}"> --}}
            <a class="nav-link {{ $isActive ? 'active' : '' }}" data-target="#{{ $target }}">
                {{ $label }}
            </a>
        </li>
    @endforeach
</ul>
