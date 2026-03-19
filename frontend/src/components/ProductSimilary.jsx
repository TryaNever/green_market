import { useEffect, useState } from "react";
import ProductCard from "./ProductCard";

export default function ProductSimilary() {
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
  return loading ? (
    <p className="text-center text-white mt-6" aria-live="polite" role="status">
      Chargement...
    </p>
  ) : error ? (
    <p
      className="text-center text-black text-xl mt-6"
      aria-live="assertive"
      role="alert"
    >
      {error}
    </p>
  ) : (
    <div>
      <div className="flex justify-center items-center mt-5">
        <hr className="border-2 rounded-full w-10 border-[#660024]" />
        <h3 className="text-[#660024] text-xl lg:text-3xl font-semibold px-1 sm:px-3">
          Produit Similaire
        </h3>
        <hr className="border-2 rounded-full w-10 border-[#660024]" />
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-1 gap-4 sm:gap-6 md:gap-8 mt-5">
        {posts.slice(0, 3).map((post) => (
          <ProductCard key={post.id} post={post} />
        ))}
      </div>
    </div>
  );
}
