export const NavSearch = () => {
  return (
    <form
      className="flex w-full max-w-md items-center justify-center"
      role="search"
      aria-label="Recherche"
    >
      <label htmlFor="search" className="sr-only">
        Recherche
      </label>
      <div className="relative">
        <input
          type="text"
          id="search"
          name="search"
          placeholder="Recherche..."
          className="w-28 sm:w-48 md:w-64 lg:w-72 rounded-lg border-none bg-gray-500/30 px-2 py-2 text-white text-sm md:text-xl shadow-xl focus:outline-none focus:ring-2 focus:ring-pink-500"
        />
        <i
          className="ri-search-line absolute right-3 top-1/2 -translate-y-1/2 text-white md:text-xl"
          aria-hidden="true"
        ></i>
      </div>
    </form>
  );
};
