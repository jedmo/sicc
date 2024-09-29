@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center user-member__title mb-30 mt-30">
                <h4 class="text-capitalize">Editar lider</h4>
            </div>
        </div>
    </div>
    <div class="card mb-50">
        <div class="row justify-content-center">
            <div class="col-sm-5 col-10">
                <div class="mt-40 mb-50">
                    @php ( $has_profile_picture = ! empty( $user->profile_picture ) )
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="account-profile d-flex align-items-center mb-4 ">
                            <div class="ap-img pro_img_wrapper">
                                <input id="profile-picture" type="file" accept="image/*" name="profile-picture" class="d-none image-upload-field" data-preview-element="profile-picture-preview">
                                <!-- Profile picture image-->
                                <label for="profile-picture">
                                    <img src="{{ $has_profile_picture ? Helper::get_public_storage_asset_url( $user->profile_picture ) : asset( 'assets/img/svg/user.svg' ) }}" alt="user" class="profile-picture-preview ap-img__main rounded-circle wh-120 bg-lighter d-flex">

                                    <span
                                        title="Pick an image"
                                        id="remove_pro_pic"
                                        class="cross clear-input-file-btn"
                                        data-input-has-file="{{ ( $has_profile_picture ) ? 1 : 0 }}"
                                        data-pick-title="Pick an image"
                                        data-pick-icon="{{ asset( 'assets/img/svg/camera-white.svg' ) }}"
                                        data-clear-title="Remove"
                                        data-clear-icon="{{ asset( 'assets/img/svg/close-white.svg' ) }}"
                                        data-input-element-id="profile-picture"
                                        data-preview-element="profile-picture-preview"
                                        data-default-preview-image="{{ asset( 'assets/img/svg/user.svg' ) }}"
                                        data-input-removal-status-field="profile-picture-removal-status"
                                    >
                                        <input type="hidden" class="profile-picture-removal-status" name="remove_profile_picture" value="">
                                        <img src="{{ ( $has_profile_picture ) ? asset( 'assets/img/svg/close-white.svg' ) : asset( 'assets/img/svg/camera-white.svg' ) }}" alt="camera">
                                    </span>
                                </label>
                            </div>
                            <div class="account-profile__title">
                                <h6 class="fs-15 ms-20 fw-500 text-capitalize">profile photo</h6>
                            </div>
                        </div>

                        <div class="edit-profile__body">
                            @include('modules.users.form')
                            <div class="button-group d-flex pt-25 justify-content-md-end justify-content-start">
                                <a href="{{ route('users.index') }}" class="btn btn-light btn-default btn-squared fw-400 text-capitalize m-sm-0 m-1">Cancelar</a>
                                <button type="submit" class="btn btn-primary btn-default btn-squared radius-md shadow2 btn-sm">Actualizar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
