@extends('layouts.app')

@section('content')
    <div class="account-pages my-2 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Demande d'essai Facturis</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">

                            <div class="p-2">

                                @include('layouts.__messages')

                                <form  class="form-horizontal" action="{{ route('try.post') }}"
                                    method="post" autocomplete="off">
                                    @csrf
                                    @honeypot
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="full_name" class="form-label">Nom complet <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="full_name"
                                                class="form-control bg-light rounded border-light  @error('full_name') is-invalid @enderror"
                                                id="full_name" value="{{ old('full_name') }}"
                                                placeholder="Votre nom complet" required autocomplete="off">

                                            @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="email" class="form-label">E-mail <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="email" name="email"
                                                class="form-control bg-light rounded border-light  @error('email') is-invalid @enderror"
                                                id="email" placeholder="Votre E-mail" value="{{ old('email') }}"
                                                required autocomplete="off">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="telephone" class="form-label">Téléphone <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="telephone"
                                                class="form-control bg-light rounded border-light  @error('telephone') is-invalid @enderror"
                                                id="telephone" placeholder="Votre téléphone" value="{{ old('telephone') }}"
                                                required autocomplete="off">

                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="country" class="form-label">Pay <span
                                                    class="text-danger">*</span></label>
                                            <select name="country"
                                                class="form-select bg-light rounded border-light form-select select2 @error('country') is-invalid @enderror"
                                                required>

                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @selected($country->name == 'Morocco' && $country->id == 1)>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">Ville <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="city"
                                                    class="form-control bg-light rounded border-light  @error('city') is-invalid @enderror"
                                                    id="city" placeholder="Votre ville" value="{{ old('city') }}"
                                                    autocomplete="off" required>

                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="mb-3 col-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Adresse <span
                                                        class="text-danger">*</span></label>
                                                <textarea type="text" name="address" rows="3"
                                                    class="form-control bg-light rounded border-light  @error('address') is-invalid @enderror" id="address"
                                                    placeholder="Votre adresse" autocomplete="off" required>{{ old('address') }} </textarea>

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="mb-3 col-4">
                                            <label for="business_name" class="form-label">Nom de l'entreprise <span
                                                    class="text-danger">*</span>

                                            </label>
                                            <input type="text" name="business_name"
                                                class="form-control bg-light rounded border-light  @error('business_name') is-invalid @enderror"
                                                id="business_name" value="{{ old('business_name') }}"
                                                placeholder="Nom de l'entreprise" required autocomplete="off">

                                            @error('business_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="ice" class="form-label">I.C.E
                                            </label>
                                            <input type="text" name="ice"
                                                class="form-control bg-light rounded border-light  @error('ice') is-invalid @enderror"
                                                id="ice" value="{{ old('ice') }}" placeholder="I.C.E"
                                                autocomplete="off">

                                            @error('ice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="website" class="form-label">Site web
                                            </label>
                                            <input type="text" name="website"
                                                class="form-control bg-light rounded border-light  @error('website') is-invalid @enderror"
                                                id="website" value="{{ old('website') }}" placeholder="Votre site web"
                                                autocomplete="off">

                                            @error('website')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <div class="mb-3 col-12">
                                        <label for="pack" class="form-label">Choisissez votre plan tarifaire
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-control rounded border-light bg-light"
                                            name="pack" id="get-pack" required>
                                            <optgroup label="Choisissez votre plan tarifaire">
                                                <option value=""></option>
                                                @foreach ($plans as $plan)
                                                    <option value="{{ $plan->uuid }}" @selected(old('pack'))>
                                                        {{ $plan->name }} => ({{ $plan->price }} DH / an)
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                 
                                    <div class="mt-3 d-grid">
                                        <x-turnstile />
                                        <button class="g-recaptcha btn btn-primary waves-effect waves-light ">
                                            Envoyer ma demande
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    @include('layouts.__footer')

                </div>
            </div>
        </div>
    </div>
@endsection
