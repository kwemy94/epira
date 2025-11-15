
<section class="content">
    <div class="container-fluid px-10">
        <div class="card card-default">
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
                                <label for="">Nom complet : </label> <span class="font-bold">{{$patient->lastname .' '.$patient->firstname}} </span>
                                <br><label for="">Date de naissance :</label>  <span class="font-bold">{{$patient->birth_name}} </span>
                                <br><label for="">Mobile/Adresse :</label>  <span class="font-bold">{{$patient->birth_name}}</span>
                                <br>
                                <label for="">Matricule/Référence interne :</label>  <span class="font-bold">{{$patient->reference}}</span></td>
                            <td style="vertical-align:top; width:50%;">
                                <table>
                                    <thead>
                                        <tr  class="bg-gray-200 text-black">
                                         <label for="">Prise en charge</label> 
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
        </div>
    </div>
</section>