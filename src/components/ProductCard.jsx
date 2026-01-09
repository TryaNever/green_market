export default function ProductCard({ post }) {
  return (
    <article
      key={post.id}
      className="z-20 rounded-2xl bg-[#851E42] overflow-hidden flex flex-col"
    >
      <div className="w-full h-48 flex items-center justify-center bg-white overflow-hidden rounded-t-2xl">
        <img
          src={post.image}
          alt={post.title}
          loading="lazy"
          width={144}
          height={144}
          className="object-contain w-full h-full p-2"
        />
      </div>

      <div className="py-4 px-3 text-center text-white">
        <h3 className="text-sm sm:text-base">{post.title}</h3>
        <p className="mb-2 text-sm sm:text-base">{post.price} €</p>
        <a
          href={`/produits/${post.id}`}
          className="rounded-2xl bg-[#E0789D] px-4 py-1 text-[#660024] font-bold text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-white/50"
        >
          Voir le produit
        </a>
      </div>
    </article>
  );
}
