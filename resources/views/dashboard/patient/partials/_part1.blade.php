<div class="row">
    @if (isset($edit))
        
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Référence  </label>
            <input type="text" readonly class="form-control required" id="name"
                value="{{ $patient->reference }}">
        </div>
    </div>
    @endif
    <div class="col-md-4">
        <div class="form-group">
            <label for="name">Nom <em style="color:red">*</em> </label>
            <input type="text" class="form-control required" id="name"
                value="{{ old('lastname', $patient->lastname ?? '') }}" name="lastname" autofocus>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="pname">Prénom</label>
            <input type="text" class="form-control" id="pname" name="firstname"
                value="{{ old('firstname', $patient->firstname ?? '') }}" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="sexe">Sexe <em style="color:red">*</em></label>
            <select id="sexe" class="form-control select2 required" name="sexe" style="width: 100%;" required>
                <option disabled {{ old('sexe', $patient->sexe ?? '') == '' ? 'selected' : '' }}>
                    Choisir le sexe
                </option>
                <option value="Féminin" {{ old('sexe', $patient->sexe ?? '') == 'Féminin' ? 'selected' : '' }}>
                    Féminin
                </option>
                <option value="Masculin" {{ old('sexe', $patient->sexe ?? '') == 'Masculin' ? 'selected' : '' }}>
                    Masculin
                </option>
            </select>
        </div>

    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="ad">Adresse</label>
            <input type="text" class="form-control" id="ad" name="address"
                value="{{ old('address', $patient->address ?? '') }}" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="dat">Date de naissance <em style="color:red">*</em></label>
            <input type="date" class="form-control required" id="dat" name="birth_date"
                value="{{ old('birth_date', $patient->birth_date ?? '') }}" placeholder="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="datl">Lieu de naissance</label>
            <input type="text" class="form-control" id="datl" name="birth_place"
                value="{{ old('birth_place', $patient->birth_place ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        {{-- <div class="form-group">
            <label>Catégorie</label>
            <select class="form-control select2" name="category_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir la catégorie</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select id="category_id" class="form-control select2" name="category_id" style="width: 100%;" required>
                <option disabled {{ old('category_id', $patient->category_id ?? '') == '' ? 'selected' : '' }}>
                    Choisir la catégorie
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $patient->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="col-md-4">
        {{-- <div class="form-group">
            <label>Status matrimoniale</label>
            <select class="form-control select2" name="matrimonial_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir</option>
                @foreach ($matrimonials as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="category_id">Statut matrimonial</label>
            <select class="form-control select2" name="matrimonial_id" style="width: 100%;">
                <option disabled {{ old('matrimonial_id', $patient->matrimonial_id ?? '') == '' ? 'selected' : '' }}>
                    Choisir
                </option>
                @foreach ($matrimonials as $matri)
                    <option value="{{ $matri->id }}"
                        {{ old('category_id', $patient->matrimonial_id ?? '') == $matri->id ? 'selected' : '' }}>
                        {{ $matri->name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="datl">Prénom et nom de la mère</label>
            <input type="text" class="form-control" id="datl" name="mother_name"
                value="{{ old('mother_name', $patient->mother_name ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="datl">Nom de jeune fille</label>
            <input type="text" class="form-control" id="datl" name="maiden_name"
                value="{{ old('maiden_name', $patient->maiden_name ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        {{-- <div class="form-group">
            <label>Indicatif (SMS)</label>
            <select class="form-control select2" name="country_id" style="width: 100%;">
                <option selected="selected" disabled>Choisir</option>
                @foreach ($countries as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="category_id">Indicatif (SMS)</label>
            <select class="form-control select2" name="country_id" style="width: 100%;">
                <option disabled {{ old('country_id', $patient->country_id ?? '') == '' ? 'selected' : '' }}>
                    Choisir
                </option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ old('category_id', $patient->country_id ?? '') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="datl">Numero mobile</label>
            <input type="text" class="form-control" id="datl" name="phone" value="{{ old('phone', $patient->phone ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="datl">Autre numéro</label>
            <input type="text" class="form-control" id="datl" name="other_phone" value="{{ old('other_phone', $patient->other_phone ?? '') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="datl">Email</label>
            <input type="email" class="form-control" id="datl" name="email" value="{{ old('email', $patient->email ?? '') }}" >
        </div>
    </div>

</div>
