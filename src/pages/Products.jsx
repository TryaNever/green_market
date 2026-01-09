import { useState } from "react";
import ProductContainer from "../components/ProductContainer";
import Footer from "../components/Footer";
import { NavSearch } from "../components/NavSearch";

export default function Products() {
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

            <NavSearch />

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

          <div className="mt-4 text-center text-white">
            <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl mb-4 font-bold">
              Green Market
            </h1>
          </div>
        </div>
      </header>

      <main className="mb-5">
        <ProductContainer titre={"Nos Produits"} />
      </main>
      <Footer />
    </div>
  );
}
