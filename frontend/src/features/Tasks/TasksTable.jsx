import { HiEye, HiMiniPencilSquare, HiMiniTrash } from "react-icons/hi2";
import staticData from "../../static data/data";

const TasksTable = () => {
  return (
    <div className="overflow-x-auto rounded-lg text-[15px]">
      <table className="table-auto border-collapse border-slate-500 w-full">
        <thead className="bg-gray-100">
          <tr>
            <th className=" px-4 py-2 text-start">Name</th>
            <th className=" px-4 py-2 text-start">Project Name</th>
            <th className=" px-4 py-2 text-start">Description</th>
            <th className=" px-4 py-2 text-start">Start Date</th>
            <th className=" px-4 py-2 text-start">End Date</th>
            {/* <th className=" px-4 py-2 text-start">Department</th> */}
            <th className=" px-4 py-2 text-start">Assigned To</th>
            <th className=" px-4 py-2 text-start">Status</th>
            <th className=" px-4 py-2 text-start">Actions</th>
          </tr>
        </thead>
        <tbody>
          {staticData.tasks.map((task, index) => (
            <tr key={index} className="">
              <td className="border-y px-4 py-2">{task.name}</td>
              <td className="border-y px-4 py-2">{task.project_id}</td>
              <td className="border-y px-4 py-4">{task.description}</td>
              <td className="border-y px-4">{task.start_date}</td>
              <td className="border-y px-4">{task.due_date}</td>
              <td className="border-y px-4">{task.assigned_to}</td>
              <td className="border-y px-4">
                <span className="p-[5px] rounded-lg bg-green-200 text-green-800">
                  Active
                </span>
              </td>
              <td className="border-y px-4">
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

export default TasksTable;
