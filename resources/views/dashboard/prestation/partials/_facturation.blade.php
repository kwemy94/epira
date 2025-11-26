<div class="card shadow-sm rounded-3 mx-auto" style="max-width: 700px;">
    <div class="card-header py-2 bg-info-light">
        <strong class="m-0">Prise en charge / Tarif</strong>
    </div>

    <div class="card-body">

        <div class="row">
            @php
                use Carbon\Carbon;
                $validInsurance = Carbon::parse($prestation?->insurer->end_date) > now();

            @endphp
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <p class="mb-2">Prise en charge en cours de validité</p>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <p class="mb-2 fw-bold">{{ $prestation?->insurer->insurer_name ?? '-' }}</p>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <p class="mb-2">Période de validité</p>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <div class="value-box mb-2">{{ $prestation?->insurer->start_date ?? '-' }} -
                    {{ $prestation?->insurer->end_date ?? '-' }}</div>
            </div>

            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <p class="mb-2">Pourcentage pris en charge</p>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <div class="value-box mb-2"> {{ $prestation?->insurer->percentage ?? '-' }} </div>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <p class="mb-2">Plafond</p>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <div class="value-box mb-2"> {{ $prestation?->insurer->max_insurance ?? '-' }} </div>
            </div>
            <div class="col-6 col-md-6 mb-6 mb-md-0">
                <p class="mb-2">Tarifs disponibles</p>
            </div>
        </div>

    </div>
</div>

<div class="row mt-3">

    <div class="col-md-6 mb-3 mb-md-0">
        <div class="card shadow-sm" style="border-radius:10px;">
            <div class="card-header py-2" style="background:#cde4fb;">
                <strong class="m-0">Détail Prix</strong>
            </div>

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6">Actes Médicaux</div>
                    <div class="col-6 text-right font-weight-bold">65000</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">Pharmacie (liée à des actes)</div>
                    <div class="col-6 text-right">0</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Pharmacie simple</div>
                    <div class="col-6 text-right">0</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Chambres</div>
                    <div class="col-6 text-right">0</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Biologie</div>
                    <div class="col-6 text-right">0</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Imagerie</div>
                    <div class="col-6 text-right">0</div>
                </div>

                <div class="row mt-3">
                    <div class="col-6 font-weight-bold">Total</div>
                    <div class="col-6">
                        <div class="p-2" style="background:#d9dbe2; border-radius:5px; text-align:right;">
                            65000
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- SECTION 3 : Quote-Part   --}}
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="card shadow-sm" style="border-radius:10px;">
            <div class="card-header py-2" style="background:#cde4fb;">
                <strong class="m-0">Quote-Part</strong>
            </div>

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-6">Patient</div>
                    <div class="col-6 text-right font-weight-bold">45500</div>
                </div>

                <div class="row">
                    <div class="col-6">Garant : AXA ASSURANCES</div>
                    <div class="col-6 text-right font-weight-bold">19500</div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="card shadow-sm rounded-3 mx-auto" style="max-width: 700px;">
    <div class="card-header py-2" style="background:#cde4fb;">
        <strong class="m-0">Facture</strong>
    </div>
    <div class="card-body">

        <div class="row text-center">
            <div class="col-4">
                <p class="mb-2">Générer</p>
                <a href="#" class="icon-click">
                    <i class="fas fa-cog fa-2x text-secondary"></i>
                </a>
            </div>
            <div class="col-4">
                <p class="mb-2">Télécharger</p>
                <a href="#" class="icon-click">
                    <i class="fas fa-file-download fa-2x" style="color:#ff355e;"></i>
                </a>
            </div>
            <div class="col-4">
                <p class="mb-2">Visualiser</p>
                <a href="#" class="icon-click">
                    <i class="fas fa-eye fa-2x" style="color:#00b894;"></i>
                </a>
            </div>

        </div>

    </div>
</div>
