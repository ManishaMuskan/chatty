<div class="fb-profile">
    <img align="left" class="fb-image-lg" src="/chatty/public/Images/user_cover.jpg" alt="Profile image example"/>
    <img align="left" class="fb-image-profile thumbnail" src="{{ $user->getGravatarImg(200) }}" alt="Profile image example"/>
    <div class="fb-profile-text">
        <h2>{{ $user->getNameOrUsername() }}</h2>
        <p>{{ $user->location ?:'location not known' }}</p>
    </div>
</div>
