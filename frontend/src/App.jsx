import "./App.css";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Dashboard from "./pages/Dashboard";

function App() {
  return (
    <main>
      <div className="bg-red-500">
        <BrowserRouter>
          <Routes>
            <Route index element={<Dashboard />} />
          </Routes>
        </BrowserRouter>
      </div>
      <div className="bg-gray-400">header</div>
      <div className="bg-yellow-200">Pages</div>
    </main>
  );
}

export default App;
