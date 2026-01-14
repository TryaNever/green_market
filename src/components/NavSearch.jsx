import { useState } from "react";

export const NavSearch = ({ setPosts = null, posts = [] }) => {
  const [query, setQuery] = useState("");

  const handleSearch = (e) => {
    const value = e.target.value;
    setQuery(value);

    if (setPosts && posts) {
      const filtered = posts.filter(
        (post) =>
          post.title.toLowerCase().includes(value.toLowerCase()) ||
          (post.content &&
            post.content.toLowerCase().includes(value.toLowerCase()))
      );
      setPosts(filtered);
    }
  };

  return (
    <form
      className="flex w-full max-w-md items-center justify-center"
      role="search"
      aria-label="Recherche"
      onSubmit={(e) => e.preventDefault()}
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
          value={query}
          onChange={handleSearch}
          className="w-28 sm:w-48 md:w-64 lg:w-72 rounded-lg border-none bg-gray-500/30 px-2 py-2 text-white text-sm md:text-xl shadow-xl 
          focus:outline-none focus:ring-2 focus:ring-pink-500"
        />
        <i
          className="ri-search-line absolute right-3 top-1/2 -translate-y-1/2 text-white md:text-xl"
          aria-hidden="true"
        ></i>
      </div>
    </form>
  );
};
