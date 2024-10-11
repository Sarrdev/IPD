@extends('layouts.admin')


    <h2 class="fw-semibold fs-4 text-gray-800">
        {{ __('Profile') }}
    </h2>



<div class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Formulaire de mise à jour des informations de profil -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Formulaire de mise à jour du mot de passe -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Formulaire de suppression de l'utilisateur -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

