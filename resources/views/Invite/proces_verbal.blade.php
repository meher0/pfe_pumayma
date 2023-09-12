@extends('layouts.invite')
   @section('content')

<style>
            /* Invite/proces_verbal.css */

        /* En-tête */
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Carte de réunion */
        .reunion-card {
            background-color: #f2f2f2;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .reunion-card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .reunion-card p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        /* Procès-verbal */
        .proces-verbal-card {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }

        .proces-verbal-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .proces-verbal-card p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        /* Message d'absence de procès-verbal */
        .no-pv-message {
            font-style: italic;
            color: #888;
            margin-top: 10px;
        }

        /* Séparateur horizontal */
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .comment-container {
            margin-bottom: 20px;
        }

        .comment {
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        .comment .content {
            margin-bottom: 10px;
        }

        .comment .content p {
            margin: 0;
        }

        .comment-details {
            margin-right: 70px;
        }

        .comment-user {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .comment-date {
            color: gray;
            font-size: 12px;
        }

        .profile-image-container {
            float: left;
            width: 50px;
            height: 50px;
            margin-top: -8px;
            margin-right: 10px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comment-details {
            margin-right: 120px;
        }



</style>

 <!-- DATA TABLE-->
 <section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">consulter des reunions</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                       <div class="row">
                        <div class="col-md-10">
                            <input type="search"  class="form-control" name="q" id="q" placeholder="search...">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-dark">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                       </div>
                     </div>
                </div>

                <h1>Reunions and Process Verbal Data</h1>

                @foreach ($reunions as $reunion)
                  <div class="reunion-card">
                    <h2>Réunion: {{ $reunion->reunion->title }}</h2>
                    <p>Objectif: {{ $reunion->reunion->objectif }}</p>
                    <p>Lieu: {{ $reunion->reunion->lieu }}</p>
                    @if ($reunion->pv)
                      <div class="proces-verbal-card">
                        <h3>Procès-verbal:</h3>
                        <p>Document: <a href="{{ route('showInvitePvDetailled', $reunion->pv->id) }}" class="btn btn-outline-primary">view document</a>
                            <span class="btn btn-outline-dark"  data-toggle="modal" data-target="#addComment{{ $reunion->pv->id }}"> <i class="fa fa-comment-dots"></i> </span>
                        </p>
                        <p>Date de création: {{ $reunion->pv->created_at }}</p>
                      </div>


                        <!-- Modal -->
                        <div class="modal fade" id="addComment{{ $reunion->pv->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Commentaire</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('handleAddComment') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <h4>Commentaires</h4>

                                            @if ($reunion->pv->comments->count() > 0)
                                                @foreach ($reunion->pv->comments as $comment)
                                                    <div class="comment mt-3">
                                                        <div class="comment-info">
                                                            <div class="profile-image-container">
                                                                <img src="{{ asset('assets/font_client/images/icon/user.webp') }}" alt="User Profile Image" class="profile-image">
                                                            </div>
                                                            <div class="comment-details">
                                                                <span class="comment-user">{{ $comment->user->name }}</span>
                                                                <span class="comment-date">{{ $comment->created_at }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="comment-content">
                                                            <p>{{ $comment->comment }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                            <p>Aucun commentaire disponible.</p>
                                            @endif
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="proces_verbal_id" value="{{ $reunion->pv->id }}">
                                            <div class="form-floating mt-3">
                                                <textarea class="form-control" name="comment" placeholder="Ecrire un commentaire ici..." id="floatingTextarea2" style="height: 80px"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-outline-success">Envoyer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                      <p class="no-pv-message">Aucun procès-verbal disponible pour cette réunion.</p>
                    @endif

                  </div>
                  <hr>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- END DATA TABLE-->




   @endsection
