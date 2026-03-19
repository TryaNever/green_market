import ProductContainer from "../components/ProductContainer";
import Footer from "../components/Footer";
import { NavSearch } from "../components/NavSearch";
import { Link } from "react-router-dom";
import MenuBurger from "../components/MenuBurger";

export default function Products() {
  return (
    <div className="flex flex-col min-h-screen overflow-hidden bg-[#E0789D] relative">
      <header className="flex flex-col items-center justify-center h-1/2 w-full p-4 sm:p-8 md:px-16 lg:px-48 rounded-b-2xl bg-[url('/img/FondFeuille.webp')] bg-cover bg-center">
        <div className="flex w-full flex-col gap-6 rounded-3xl bg-black/50 px-8 sm:px-16 py-6 sm:py-8 shadow-lg backdrop-blur-md">
          <div className="flex items-center justify-between gap-8">
            <Link
              to="/"
              className="text-xl font-bold text-white md:text-4xl focus:outline-none focus:ring-2 focus:ring-white/50"
            >
              GM
            </Link>
            <NavSearch />
            <MenuBurger />
            <nav
              className="hidden md:flex gap-5 text-white text-xl"
              role="navigation"
              aria-label="Menu principal"
            >
              <Link
                to="/"
                className="focus:outline-none focus:ring-2 focus:ring-white/50 rounded"
              >
                Home
              </Link>
              <Link
                to="/produits"
                className="focus:outline-none focus:ring-2 focus:ring-white/50 rounded"
              >
                Produits
              </Link>
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
