import { HiEye, HiMiniPencilSquare, HiMiniTrash } from "react-icons/hi2";

import { useEffect, useState } from "react";
import axios from "axios";

const DepartmentsTable = () => {
  const [data, setData] = useState([]);

  useEffect(() => {
    axios
      .get("https://dev.expertrobot.pro/api/departments")
      .then((res) => {
        setData(res.data);
        console.log(data);
      })
      .catch((error) => {
        console.log(error);
      });
  }, []);

  return (
    <div className="overflow-x-auto rounded-lg text-[15px]">
      <table className="table-auto border-collapse border-slate-500 w-full">
        <thead className="bg-gray-100">
          <tr>
            <th className=" px-4 py-2 text-start">Name</th>
            <th className=" px-4 py-2 text-start">Company Name</th>
            <th className=" px-4 py-2 text-start">Description</th>
            <th className=" px-4 py-2 text-start">Status</th>
            <th className=" px-4 py-2 text-start">Actions</th>
          </tr>
        </thead>
        <tbody>
          {data.map((department, index) => (
            <tr key={index} className="">
              <td className="border-y px-4 py-4">{department.name}</td>
              <td className="border-y px-4 ">{department.company_id}</td>
              <td className="border-y px-4 ">{department.description}</td>
              <td className="border-y px-4 ">
                <span
                  className={
                    department.active === true
                      ? "p-[8px] rounded-lg bg-green-300 text-gray-900 font-semibold"
                      : "p-[8px] rounded-lg bg-red-300 text-gray-900 font-semibold"
                  }
                >
                  {department.active === true ? "Active" : "Inactive"}
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

export default DepartmentsTable;
