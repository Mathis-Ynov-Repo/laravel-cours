@extends("layouts.app")
@section("content")
<div class="container">
	<h1>Se connecter / S'enregistrer avec un compte social</h1>
	<p>
		<!-- Lien de redirection vers Google -->
		<a style="display: flex; flex-direction: column; align-items: center" href="{{ route('socialite.redirect', 'google') }}" title="Connexion/Inscription avec Google" class="btn btn-link"  >
			<img style="max-width: 500px" src="https://cdn.pixabay.com/photo/2015/12/11/11/43/google-1088004_1280.png">
		Continuer avec Google
		</a>
	</p>
</div>
@endsection