import { useState } from "react";
import { Link } from "react-router-dom";

export default function MenuBurger() {
  const [openMenu, setOpenMenu] = useState(false);

  return (
    <>
      <button
        className="ri-menu-line text-3xl text-white cursor-pointer md:hidden focus:outline-none focus:ring-2 focus:ring-white/50 rounded"
        onClick={() => setOpenMenu(true)}
        aria-label="Ouvrir le menu"
      ></button>
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
            role="navigation"
            aria-label="Menu principal mobile"
          >
            <Link
              to="/"
              className="focus:outline-none focus:ring-2 focus:ring-white/50 rounded px-2 py-1"
            >
              Accueil
            </Link>
            <Link
              to="/produits"
              className="focus:outline-none focus:ring-2 focus:ring-white/50 rounded px-2 py-1"
            >
              Produits
            </Link>
          </nav>
        </aside>
      )}
    </>
  );
}
