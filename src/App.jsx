import { BrowserRouter, Routes, Route } from "react-router-dom";
import React, { Suspense } from "react";

const Home = React.lazy(() => import("./pages/Home"));
const Products = React.lazy(() => import("./pages/Products"));
const ProductDetail = React.lazy(() => import("./pages/ProductDetail"));

export default function App() {
  return (
    <BrowserRouter>
      <Suspense
        fallback={
          <p
            role="status"
            aria-live="polite"
            className="text-center mt-10 text-xl"
          >
            Chargement…
          </p>
        }
      >
        <Routes>
          <Route index element={<Home />} />
          <Route path="/produits" element={<Products />} />
          <Route path="/produits/:id" element={<ProductDetail />} />
          <Route
            path="*"
            element={
              <>
                <p>Désolé la page que vous cherchez existe pas.</p>
                <a href="/" className="text-blue-600 underline">
                  Retour a l'accueil
                </a>
              </>
            }
          />
        </Routes>
      </Suspense>
    </BrowserRouter>
  );
}
