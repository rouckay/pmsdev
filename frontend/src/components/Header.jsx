import { HiArrowRightOnRectangle, HiOutlineUser } from "react-icons/hi2";

const Header = () => {
  return (
    <header className="bg-white-100 px-4 py-8 border-b-4 border-gray-100 w-full">
      <div>
        <ul className="flex gap-6 justify-end">
          <li className="flex gap-1 items-center hover:text-blue-600 active:text-blue-600">
            <img
              src="../src/img/default-user.jpg"
              alt="User Photo"
              className="h-[30px] w-[30px] rounded-full"
            />
            <span className="text-lg">Admin</span>
          </li>
          <li>
            <button className="flex gap-1 items-center hover:text-blue-600 active:text-blue-600">
              <span className="text-lg">Account</span>
              <HiOutlineUser className="h-6 w-6" />
            </button>
          </li>
          <li>
            <button className="flex gap-1 items-center hover:text-blue-600 active:text-blue-600">
              <span className="text-lg">Log out</span>
              <HiArrowRightOnRectangle className="h-6 w-6" />
            </button>
          </li>
        </ul>
      </div>
    </header>
  );
};

export default Header;
