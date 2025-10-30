<div class="row">

<div class="row" style="max-width: 800px; margin:auto;">
    <div class="row">
        <h3>Identité du patient</h3>    
    </div>
    <div class="row">
        <div class="col-md-6">
            <div>
                <strong>Nom :</strong>
                <p class="text-muted">
                    {{ $patient->lastname }}
                </p>
            </div>
            <div>
                <strong>Date de naissance :</strong>
                <p class="text-muted">
                    {{ $patient->date }}
                </p>
            </div>
            <div>
                <strong>Mobile :</strong>
                <p class="text-muted">
                    {{ $patient->lastname }}
                </p>
            </div>
            <div>
                <strong>Nom :</strong>
                <p class="text-muted">
                    {{ $patient->lastname }}
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <table>
                <tr>
                    <th>Assureur</th>
                    <th>Numéro de police</th>
                </tr>
                {{-- @dd($patient->contacts[0]->pivot()) --}}
                @forelse ($patient->insurer as $prestation)
                    <tr>
                        <td>{{ $prestation->insurer_name }}</td>
                        <td>{{ $prestation->insurer_employer }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Aucun assureur trouvé.</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

</div>
</div>