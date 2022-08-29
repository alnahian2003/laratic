{{-- Modal Form --}}
<form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- Post Title --}}
    <label class="block mt mb-2 text-sm font-medium" for="title">Post Title</label>
    <input type="text" name="title" id="title" placeholder="Give a post title" class="input input-bordered w-full focus:border-green-500 mb-2 @error('title') input-error @enderror" value="{{old('title')}}"/>

    @error ('title')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- Post Content --}}
    <label class="block mt-5 mb-2 text-sm font-medium" for="body">Post Details</label>
    <textarea class="textarea textarea-bordered w-full focus:border-green-500 @error('body') textarea-error @enderror" id="body" name="body" placeholder="Write post details">{{old('body')}}</textarea>

    @error ('body')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- Post Cover Image --}}
    <label class="block mt-5 mb-2 text-sm font-medium" for="file_input">Upload Cover Image</label>

    <input class="block w-full p-3 text-sm text-gray-900 rounded-lg border cursor-pointer focus:outline-none bg-gray-700 border-gray-600 @error('cover') border-error @enderror placeholder-gray-400" id="file_input" name="cover" type="file">
    <p class="mt-1 text-sm" id="file_input_help">PNG, JPG or GIF (MAX 10MB).</p>

    @error ('cover')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    <br>
    <button type="submit" class="btn font-extrabold bg-gradient-to-l from-sky-600 to-success text-white mt-4 bottom-0">Let's Do It 🎉</button>
</form>