import { BrowserRouter, Routes, Route } from "react-router-dom";

import { Navbar } from "./components/Navbar.jsx";
import React, { Suspense } from "react";
const Home = React.lazy(() => import("./pages/Home"));

export default function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Suspense fallback={<p>Chargement…</p>}>
        <Routes>
          <Route index element={<Home />} />
          <Route path="*" element={<p>Page introuvable</p>} />
        </Routes>
      </Suspense>
    </BrowserRouter>
  );
}
