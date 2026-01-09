import { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import { NavSearch } from "../components/NavSearch";
import Footer from "../components/Footer";
import ProductSimilary from "../components/ProductSimilary";
import MenuBurger from "../components/MenuBurger";

export default function ProductDetail() {
  const { id } = useParams();
  const [post, setPost] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchPost = async () => {
      try {
        const response = await fetch(`https://fakestoreapi.com/products/${id}`);
        if (!response.ok)
          throw new Error("Erreur lors du chargement des produits");
        const res = await response.json();
        setPost(res);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };
    fetchPost();
    console.log(post);
  }, []);

  return (
    <div className="flex flex-col min-h-screen overflow-hidden bg-[#E0789D] relative">
      <header className="flex flex-col items-center justify-center h-1/2 w-full p-4 sm:p-8 md:px-16 lg:px-48 rounded-b-2xl bg-[url('/img/FondFeuille.webp')] bg-cover bg-center">
        <div className="flex w-full flex-col gap-6 rounded-3xl bg-black/50 px-8 sm:px-16 py-6 sm:py-8 shadow-lg backdrop-blur-md">
          <div className="flex items-center justify-between gap-8">
            <p className="text-xl font-bold text-white md:text-4xl">GM</p>
            <NavSearch />
            <MenuBurger />
            <nav className="hidden md:flex gap-5 text-white text-xl">
              <Link to="/">Home</Link>
              <Link to="/produits">Produits</Link>
            </nav>
          </div>

          <div className="mt-4 text-center text-white">
            <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl mb-4 font-bold">
              Green Market
            </h1>
          </div>
        </div>
      </header>

      <main className="mb-5 px-10 sm:px-20 lg:flex xl:mt-10 justify-between 2xl:px-40">
        {loading ? (
          <p
            role="status"
            aria-live="polite"
            className="text-center text-white mt-6"
          >
            Chargement…
          </p>
        ) : error ? (
          <p
            role="alert"
            aria-live="assertive"
            className="text-center text-black text-xl mt-6"
          >
            {error}
          </p>
        ) : (
          <div className=" mt-5 lg:w-1/2">
            <div className="flex flex-col items-center gap-4">
              <img
                src={post.image}
                alt={post.title}
                className="w-full px-[20%] sm:px-40 md:px-60 lg:px-40"
                loading="lazy"
              />
              <h2 className="text-4xl font-semibold text-center text-[#660024]">
                {post.title}
              </h2>
              <p className="text-black text-xl md:text-2xl lg:text-3xl font-semibold">
                {post.price} €
              </p>
              <Link
                to="/produits"
                className="bg-[#660024] text-white rounded-full px-4 py-2 text-lg"
              >
                Retour aux produits
              </Link>
            </div>
            <div>
              <div className="flex justify-center items-center w-full mt-5">
                <hr className="border-2 rounded-full w-12 border-[#660024]" />
                <h3 className="text-[#660024] text-xl lg:text-4xl font-semibold p-3">
                  Description
                </h3>
                <hr className="border-2 rounded-full w-12 border-[#660024]" />
              </div>
              <p className="text-center text-sm lg:text-base mt-3">
                {post.description}
              </p>
            </div>
          </div>
        )}

        <ProductSimilary />
      </main>
      <Footer />
    </div>
  );
}
