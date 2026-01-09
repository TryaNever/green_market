import { BrowserRouter, Routes, Route } from "react-router-dom";

import React, { Suspense } from "react";
import Products from "./pages/Products";
const Home = React.lazy(() => import("./pages/Home"));

export default function App() {
  return (
    <BrowserRouter>
      <Suspense fallback={<p>Chargement…</p>}>
        <Routes>
          <Route index element={<Home />} />
          <Route path="/produits" element={<Products />} />
          <Route path="/product/:id" element />
          <Route path="*" element={<p>Page introuvable</p>} />
        </Routes>
      </Suspense>
    </BrowserRouter>
  );
}
