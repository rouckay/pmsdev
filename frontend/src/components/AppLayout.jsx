import { Outlet } from "react-router-dom";
import Header from "./Header";
import Sidebar from "./Sidebar";

const AppLayout = () => {
  return (
    <div>
      <Header />
      <Sidebar />
      <main className="bg-red-400 pt-8 pl-4 pr-4 pb-8">
        <Outlet />
      </main>
    </div>
  );
};

export default AppLayout;
