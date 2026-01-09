import { useEffect, useState } from "react";
import ProductCard from "./ProductCard";

export default function ProductContainer({ titre, limite }) {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchPost = async () => {
      try {
        const response = await fetch("https://fakestoreapi.com/products");
        if (!response.ok)
          throw new Error("Erreur lors du chargement des produits");
        const res = await response.json();
        setPosts(res);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };
    fetchPost();
  }, []);

  return (
    <section
      id="produits"
      className="relative w-full mt-6 sm:mt-8 px-4 sm:px-8 md:px-16 lg:px-48"
    >
      <i
        className="ri-flower-line absolute -left-12 -top-6 rotate-18 text-[120px] sm:text-[160px] text-[#660024] z-10"
        aria-hidden="true"
      ></i>
      <h2 className="my-4 md:my-8 text-center text-3xl sm:text-4xl md:text-5xl font-medium text-[#660024]">
        {titre}
      </h2>

      {loading ? (
        <p className="text-center text-white mt-6">Chargement...</p>
      ) : error ? (
        <p className="text-center text-black text-xl mt-6">{error}</p>
      ) : (
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
          {(limite ? posts.slice(0, 6) : posts).map((post) => (
            <ProductCard key={post.id} post={post} />
          ))}
        </div>
      )}
    </section>
  );
}
