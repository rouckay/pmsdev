import { Outlet } from "react-router-dom";
import Header from "./Header";
import Sidebar from "./Sidebar";

const AppLayout = () => {
  return (
    <div className="grid grid-cols-[16rem_1fr] grid-rows-[auto_1fr] min-h-screen max-h-screen">
      <div className="row-span-2">
        <Sidebar />
      </div>
      <div className="col-start-2">
        <Header />
      </div>
      <main className="col-start-2 row-start-2 py-8 px-4 overflow-y-auto">
        <Outlet />
      </main>
    </div>
  );
};

export default AppLayout;
