<div class="fb-profile">
    <img align="left" class="fb-image-lg" src="/chatty/public/Images/user_cover.jpg" alt="Cover image"/>
    <img align="left" class="fb-image-profile thumbnail" src="{{ $user->getGravatarImg(200) }}" alt="{{ strtoupper(substr($user->first_name, 0, 1)) }}"/>
    <div class="fb-profile-text">
        <h2>{{ $user->getNameOrUsername() }}</h2>
        <p>{{ $user->location ?:'location not known' }}</p>
    </div>
</div>
