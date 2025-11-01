<div class="row z-50">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="bg-primary text-white" colspan="6">Identité Patient(e)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align:top; width:50%;">
                    Nom complet : <span class="font-bold">{{$patient->lastname .' '.$patient->firstname}} </span>
                    <br>Date de naissance : <span class="font-bold">{{$patient->birth_name}} </span>
                    <br>Mobile/Adresse : <span class="font-bold">{{$patient->birth_name}}</span>
                    <br>
                    Matricule/Référence interne : <span class="font-bold">{{$patient->reference}}</span></td>
                <td style="vertical-align:top; width:50%;">
                    <table>
                        <thead>
                            <tr  class="bg-gray-200 text-black">
                               Prise en charge
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-blue-200 text-black">
                                <td>Assureur</td>
                                <td>Période de validité</td>
                                <td>Pourcentage(%)</td>
                                <td>Plafond</td>
                            </tr>
                                <tr>
                                    <td>{{$prestation->insurer?->insurer_name}}</td>
                                    <td>{{$prestation->insurer?->start_date}} -{{$prestation->insurer?->end_date}}</td>
                                    <td>{{$prestation->insurer?->pourcentage}}</td>
                                    <td>{{$prestation->insurer?->max_insurance}}</td>
                                </tr>
                            
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div><br>
