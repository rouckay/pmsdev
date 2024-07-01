import AddTasks from "../features/Tasks/AddTasks";
import TasksTable from "../features/Tasks/TasksTable";

const Tasks = () => {
  return (
    <div className="flex flex-col gap-4">
      <AddTasks />
      <TasksTable />
    </div>
  );
};

export default Tasks;
