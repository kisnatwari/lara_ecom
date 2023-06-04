<div class="w-full h-96 relative overflow-hidden -my-2">

    <video class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 min-w-full min-h-full object-cover object-center" autoplay muted loop>
      <source src="{{ Storage::url('/video-bg.mp4') }}" type="video/mp4" />
    </video>

  <div class="absolute top-0 left-0 w-full h-full flex flex-col bg-black bg-opacity-80 justify-center items-center">
    <h1 class="text-white text-3xl font-bold mb-4 text-center">Discover Local Products and Support Your Community</h1>
    <h2 class="text-white text-md font-medium mb-8 text-center">Discover unique and authentic products from local businesses in your community <br /> and help support your local economy</h2>
    <form class="bg-white flex items-center rounded-lg py-2 px-4 w-11/12 sm:w-4/5 lg:w-2/3 xl:w-1/2 mb-7">
        <input class="rounded-md bg-white w-full py-2 px-4 mr-2 text-gray-700 leading-tight focus:outline-none focus:ring-0 border-0" id="search" type="text" placeholder="Search Products, Vendors......." />
        <button type="submit" class="bg-indigo-600 flex gap-2 items-center hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
          <i class="fa fa-search text-sm"></i> <span>Search</span>
        </button>
      </form>
    <div class="relative">
      <button class="px-6 py-3 bg-gray-300 rounded-md flex items-center justify-center gap-2">
        <i class="fa fa-category"></i>
        <span class="text-gray-700 font-medium text-lg">Browse Categories</span>
      </button>
    </div>
  </div>
</div>