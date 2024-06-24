import { HiEye, HiMiniPencilSquare, HiMiniTrash } from "react-icons/hi2";
import staticData from "../../static data/data";

const UsersTable = () => {
  return (
    <div className="overflow-x-auto rounded-lg text-[15px]">
      <table className="table-auto border-collapse border-slate-500 w-full">
        <thead className="bg-gray-100">
          <tr>
            <th className=" px-4 py-2 text-start">Name</th>
            <th className=" px-4 py-2 text-start">Email</th>
            <th className=" px-4 py-2 text-start">Phone Number</th>
            <th className=" px-4 py-2 text-start">Address</th>
            <th className=" px-4 py-2 text-start">Role</th>
            <th className=" px-4 py-2 text-start">Status</th>
            <th className=" px-4 py-2 text-start">Actions</th>
          </tr>
        </thead>
        <tbody>
          {staticData.users.map((user, index) => (
            <tr key={index} className="">
              <td className="border-y px-4 py-4">{user.name}</td>
              <td className="border-y px-4 ">{user.email}</td>
              <td className="border-y px-4 ">{user.phone_number}</td>
              <td className="border-y px-4 ">{user.address}</td>
              <td className="border-y px-4 ">{user.type}</td>
              <td className="border-y px-4 ">
                <span
                  className={
                    user.active === true
                      ? "p-[8px] rounded-lg bg-green-300 text-gray-900 font-semibold"
                      : "p-[8px] rounded-lg bg-red-300 text-gray-900 font-semibold"
                  }
                >
                  {user.active === true ? "Active" : "Inactive"}
                </span>
              </td>
              <td className="border-y px-4 ">
                <div className="flex gap-3">
                  <HiEye />
                  <HiMiniPencilSquare />
                  <HiMiniTrash />
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default UsersTable;
