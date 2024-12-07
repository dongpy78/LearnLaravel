<x-profile :avatar="$avatar" :username="$username" :currentlyFollowing="$currentlyFollowing" :postCount="$postCount">
  <div class="list-group">
    @foreach ($posts as $post)
      <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
        <img style="width: 32px; height: 32px; border-radius: 16px" class="avatar-tiny" src="{{$post->user->avatar}}" />
        <strong>{{ $post->title }}</strong> {{ $post->created_at->format('j/n/Y') }}
      </a>
    @endforeach               
  </div>
</x-profile>


