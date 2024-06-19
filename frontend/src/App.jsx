import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Dashboard from "./pages/Dashboard";
import Departments from "./pages/Departments";
import Users from "./pages/Users";
import Settings from "./pages/Settings";
import Messages from "./pages/Messages";
import Login from "./pages/Login";
import AppLayout from "./components/AppLayout";

import { Toaster } from "react-hot-toast";

function App() {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route element={<AppLayout />}>
            <Route index element={<Navigate replace="dashboard" />} />
            <Route path="dashboard" element={<Dashboard />} />
            <Route path="departments" element={<Departments />} />
            <Route path="users" element={<Users />} />
            <Route path="settings" element={<Settings />} />
            <Route path="messages" element={<Messages />} />
          </Route>

          <Route path="login" element={<Login />} />
        </Routes>
      </BrowserRouter>
      <Toaster
        position="top-center"
        gutter={12}
        containerStyle={{
          margin: "9px",
        }}
        toastOptions={{
          success: {
            duration: 3000,
          },
          error: {
            duration: 5000,
          },
          style: {
            fontSize: "16px",
            maxWidth: "500px",
            padding: "16px 24px",
          },
        }}
      />
    </>
  );
}

export default App;
