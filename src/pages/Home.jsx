import { useState } from "react";
import ProductContainer from "../components/ProductContainer";
import Footer from "../components/Footer";

export default function Home() {
  const [openMenu, setOpenMenu] = useState(false);

  return (
    <div className="flex flex-col min-h-screen overflow-hidden bg-[#E0789D] relative">
      {openMenu && (
        <aside
          className="
            absolute top-0 right-0 md:hidden  
            z-50
            w-80 h-80 
            bg-[#388B21] rounded-full
            transform translate-x-[30%] -translate-y-[30%]
          "
          role="dialog"
          aria-modal="true"
          aria-label="Menu principal"
        >
          <button
            className="text-white text-3xl absolute top-[35%] right-[35%] focus:outline-none focus:ring-4 focus:ring-white/50 rounded-full"
            onClick={() => setOpenMenu(false)}
            aria-label="Fermer le menu"
          >
            ✕
          </button>

          <nav
            className="flex flex-col absolute top-[55%] right-[45%] gap-4 text-white text-lg"
            role="menu"
          >
            <a
              href="/"
              role="menuitem"
              className="focus:outline-none focus:ring-2 focus:ring-white/50 rounded px-2 py-1"
            >
              Accueil
            </a>
            <a
              href="/produits"
              role="menuitem"
              className="focus:outline-none focus:ring-2 focus:ring-white/50 rounded px-2 py-1"
            >
              Produits
            </a>
          </nav>
        </aside>
      )}

      <header className="flex flex-col items-center justify-center h-1/2 w-full p-4 sm:p-8 md:px-16 lg:px-48 rounded-b-2xl bg-[url('/img/FondFeuille.webp')] bg-cover bg-center">
        <div className="flex w-full flex-col gap-6 rounded-3xl bg-black/50 px-8 sm:px-16 py-6 sm:py-8 shadow-lg backdrop-blur-md">
          <div className="flex items-center justify-between gap-8">
            <p className="text-xl font-bold text-white md:text-4xl">GM</p>

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
                  placeholder="Recherche..."
                  className="w-36 sm:w-48 md:w-64 lg:w-72 rounded-lg border-none bg-gray-500/30 px-2 py-2 text-white md:text-xl shadow-xl focus:outline-none focus:ring-2 focus:ring-pink-500"
                />
                <i
                  className="ri-search-line absolute right-3 top-1/2 -translate-y-1/2 text-white md:text-xl"
                  aria-hidden="true"
                ></i>
              </div>
            </form>

            <button
              className="ri-menu-line text-3xl text-white cursor-pointer md:hidden focus:outline-none focus:ring-2 focus:ring-white/50 rounded"
              onClick={() => setOpenMenu(true)}
              aria-label="Ouvrir le menu"
            ></button>

            <nav className="hidden md:flex gap-5 text-white text-xl">
              <a href="/">Home</a>
              <a href="/produits">Produits</a>
            </nav>
          </div>

          <img
            src="public/img/eco.webp"
            alt="Image décorative illustrant Green Market"
            loading="lazy"
            width={144}
            height={144}
            className="mx-auto rounded-2xl w-full max-w-lg"
          />

          <div className="mt-4 text-center text-white">
            <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl mb-4 font-bold">
              Green Market
            </h1>
            <p className="mb-6 text-sm sm:text-base lg:text-lg">
              Green market vous propose une nouvelle approche pour une
              consomation plus durable et plus éco-responsable
            </p>
            <a
              className="rounded-2xl bg-gray-500/50 px-6 py-2 shadow-xl text-sm sm:text-base md:text-xl"
              href="/produits"
            >
              Voir Les Produits →
            </a>
          </div>
        </div>
      </header>

      <main>
        <ProductContainer titre="Produits phares" limite={true} />

        <section className="mt-6 pb-6 sm:mt-8 flex flex-col items-center rounded-t-2xl bg-[url('/img/FondFeuille.webp')] bg-cover bg-center px-4 sm:px-8 md:px-16 lg:px-48">
          <h2 className="w-full my-6 lg:my-10 rounded-2xl bg-black/50 px-4 py-2 text-center text-xl md:text-3xl text-white backdrop-blur-md">
            Catégorie
          </h2>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-8 w-full">
            <article className="flex items-center justify-between rounded-2xl bg-black/50 backdrop-blur-md">
              <h3 className="text-white text-lg md:text-xl px-8 py-2 bg-white/10 rounded-2xl shadow-lg mx-auto">
                Sweet
              </h3>
              <img
                src="/public/img/eco.webp"
                loading="lazy"
                width={144}
                height={144}
                alt="Illustration de la catégorie"
                className="w-24 sm:w-36 rounded-2xl"
              />
            </article>
            <article className="flex items-center justify-between rounded-2xl bg-black/50 backdrop-blur-md">
              <h3 className="text-white text-lg md:text-xl px-8 py-2 bg-white/10 rounded-2xl shadow-lg mx-auto">
                Sweet
              </h3>
              <img
                src="/public/img/eco.webp"
                loading="lazy"
                width={144}
                height={144}
                alt="Illustration de la catégorie"
                className="w-24 sm:w-36 rounded-2xl"
              />
            </article>
            <article className="flex items-center justify-between rounded-2xl bg-black/50 backdrop-blur-md">
              <h3 className="text-white text-lg md:text-xl px-8 py-2 bg-white/10 rounded-2xl shadow-lg mx-auto">
                Sweet
              </h3>
              <img
                src="/public/img/eco.webp"
                loading="lazy"
                width={144}
                height={144}
                alt="Illustration de la catégorie"
                className="w-24 sm:w-36 rounded-2xl"
              />
            </article>
            <article className="flex items-center justify-between rounded-2xl bg-black/50 backdrop-blur-md">
              <h3 className="text-white text-lg md:text-xl px-8 py-2 bg-white/10 rounded-2xl shadow-lg mx-auto">
                Sweet
              </h3>
              <img
                src="/public/img/eco.webp"
                loading="lazy"
                width={144}
                height={144}
                alt="Illustration de la catégorie"
                className="w-24 sm:w-36 rounded-2xl"
              />
            </article>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
