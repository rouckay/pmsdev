import { useState } from "react";
import { NavLink } from "react-router-dom";
import {
  HiOutlineHome,
  HiMiniUserGroup,
  HiMiniUsers,
  HiCog6Tooth,
  HiChatBubbleLeftRight,
} from "react-icons/hi2";

const Sidebar = () => {
  const [activeIndex, setActiveIndex] = useState(null);

  const menuItems = [
    { to: "/dashboard", label: "Dashboard", Icon: HiOutlineHome },
    { to: "/departments", label: "Departments", Icon: HiMiniUserGroup },
    { to: "/users", label: "Users", Icon: HiMiniUsers },
    { to: "/settings", label: "Settings", Icon: HiCog6Tooth },
    { to: "/messages", label: "Messages", Icon: HiChatBubbleLeftRight },
  ];

  return (
    <aside className="flex flex-col bg-white-100 px-8 py-8 border-r-2 border-white-100 h-screen gap-y-8">
      <div className="flex flex-col items-center gap-2">
        <img
          className="rounded-full h-32 w-32"
          src="/programmer.jpg"
          alt="project management logo"
        />
        <h1 className="font-extrabold text-xl">PMS</h1>
      </div>
      <nav>
        <ul className="ul">
          {menuItems.map((item, index) => (
            <li key={item.to}>
              <NavLink
                className={({ isActive }) =>
                  `flex items-center gap-5 text-gray-600 text-base font-medium p-3 transition-all duration-300 ${
                    isActive || activeIndex === index
                      ? "text-blue-800 bg-gray-50 rounded-sm"
                      : "hover:text-gray-800 hover:bg-gray-50 hover:rounded-sm"
                  }`
                }
                to={item.to}
                onClick={() => setActiveIndex(index)}
              >
                <item.Icon
                  className={`w-6 h-6 transition-all duration-300 ${
                    activeIndex === index
                      ? "text-blue-600"
                      : "text-gray-400 hover:text-blue-600"
                  }`}
                />
                <span>{item.label}</span>
              </NavLink>
            </li>
          ))}
        </ul>
      </nav>
    </aside>
  );
};

export default Sidebar;
