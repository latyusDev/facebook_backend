{{-- @props(['post' => $post]) --}}
<div class="mb-4">
    <a href="{{route('users.posts', $post->user)}}" class="font-bold capitalize"> {{$post->user->username}} </a>
     <span class="text-gray-600 text-sm"> {{$post->created_at }}</span>
    <p class="mb-2">{{ $post->body}}</p>
    {{-- @if ($post->ownedBy(auth()->user())) --}}

    @can('delete', $post)
        <form action="{{route('destroy', $post)}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-blue-500">delete</button>
        </form>
    @endcan
    {{-- @endif --}}


    <div class="flex items-center">
        @auth
            
        @if (!$post->likedBy(auth()->user()))
            
        <form action=" {{ route('posts.likes', $post)}}" method="post" class="mr-1">
            @csrf
            <button type="submit" class="text-blue-500">Like</button>
        </form>
        
        @else
            
        <form action=" {{ route('posts.unlikes', $post)}}" method="post" class="mr-1">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-blue-500">Unlike</button>
        </form>
        @endif
      
        @endauth
        <span>{{ $post->likes->count()}} {{Str::plural('like', $post->likes->count())}} </span>
    </div>
   </div>