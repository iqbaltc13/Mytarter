@extends('layouts.dashboard_modul')
@section('content')
<div class="uk-flex-center" data-uk-grid>
    <div class="uk-width-4-4@l">
        <div class="uk-card">
            <div class="uk-card-header sc-padding">
                <div class="uk-flex uk-flex-left">
                    <h2 class="uk-card-title">
                       Edit Profile
                    </h2>
                </div>
            </div>
            <div class="uk-card-body">
                    <form method="POST" id="form_advanced_validation" class="form-update-program" action="{{route('dashboard.profil.update')}}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    @include('dashboard.profile.form_edit')
                    <div class="uk-margin-top">
                        <button type="submit" class="sc-button sc-button-primary sc-button-large">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
</script>
<script>
flatpickr(".flatpickr-input");
</script>
@endpush
@endsection