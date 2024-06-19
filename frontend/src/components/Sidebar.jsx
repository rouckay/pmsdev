import { useState } from "react";
import { NavLink } from "react-router-dom";

import { HiOutlineHome } from "react-icons/hi2";
import { HiMiniUserGroup } from "react-icons/hi2";
import { HiMiniUsers } from "react-icons/hi2";
import { HiCog6Tooth } from "react-icons/hi2";
import { HiChatBubbleLeftRight } from "react-icons/hi2";

const Sidebar = () => {
  const [active, setActive] = useState(false);

  return (
    <aside className="flex flex-col bg-white-100 px-8 py-8 border-r-2 border-white-100 h-screen gap-y-8">
      <div className=" flex flex-col items-center gap-2">
        <img
          className="rounded-full h-32 w-32"
          src="/programmer.jpg"
          alt="project mannagement log"
        />
        <h1 className="font-extrabold text-xl">PMS</h1>
      </div>
      <nav>
        <ul className="ul">
          <li>
            <NavLink className="nav" to="/dashboard">
              <HiOutlineHome className="svg" />
              <span>Dashboard</span>
            </NavLink>
          </li>
          <li>
            <NavLink className="nav" to="/departments">
              <HiMiniUserGroup className="svg" />
              <span>Departments</span>
            </NavLink>
          </li>
          <li>
            <NavLink className="nav" to="/users">
              <HiMiniUsers className="svg" />
              <span>Users</span>
            </NavLink>
          </li>
          <li>
            <NavLink className="nav" to="/settings">
              <HiCog6Tooth className="svg" />
              <span>Settings</span>
            </NavLink>
          </li>
          <li>
            <NavLink className="nav" to="/messages">
              <HiChatBubbleLeftRight className="svg" />
              <span>Messages</span>
            </NavLink>
          </li>
        </ul>
      </nav>
    </aside>
  );
};

export default Sidebar;
