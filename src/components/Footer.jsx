import { Link } from "react-router-dom";

export default function Footer() {
  return (
    <footer className="bg-[#2A2A2A] text-white py-8 px-4 sm:px-8 md:px-16 lg:px-48">
      <h2 className="text-center text-lg sm:text-xl mb-2">Green Market</h2>

      <hr className="border-white mb-4" />

      <nav
        aria-label="Navigation footer"
        className="flex flex-col items-center gap-2 mb-4"
      >
        <Link
          to="/"
          className="hover:underline focus:outline-none focus:ring-2 focus:ring-white/50 italic"
        >
          Acceuil
        </Link>
        <Link
          to="/produits"
          className="hover:underline focus:outline-none focus:ring-2 focus:ring-white/50 italic"
        >
          Produit
        </Link>
      </nav>

      <hr className="border-white mb-2" />

      <p className="text-center text-white/60 text-sm">©2025 • Green Market</p>
    </footer>
  );
}
