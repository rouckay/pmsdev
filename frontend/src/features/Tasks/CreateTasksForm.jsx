import { useForm } from "react-hook-form";

const projects = [
  { id: 1, name: "Project 1" },
  { id: 2, name: "Project 2" },
];

const users = [
  { id: 1, name: "User 1", department: "Engineering" },
  { id: 2, name: "User 2", department: "Marketing" },
];

const departments = [
  { id: 1, name: "Engineering" },
  { id: 2, name: "Marketing" },
];

const TaskForm = () => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();
  const onSubmit = (data) => console.log(data);

  return (
    <form
      onSubmit={handleSubmit(onSubmit)}
      className="flex flex-col space-y-4 p-4 max-w-lg mx-auto bg-white rounded shadow-md"
    >
      <h2 className="text-2xl font-bold mb-4 self-center">Create Task</h2>

      <div className="flex flex-wrap -mx-2">
        <div className="w-full md:w-1/2 px-2 mb-4 md:mb-0">
          <label htmlFor="name" className="mb-1 block">
            Task Name
          </label>
          <input
            id="name"
            {...register("name", { required: true })}
            className="p-2 border rounded w-full"
          />
          {errors.name && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>

        <div className="w-full md:w-1/2 px-2">
          <label htmlFor="project" className="mb-1 block">
            Project
          </label>
          <select
            id="project"
            {...register("project_id", { required: true })}
            className="p-2 border rounded w-full"
          >
            {projects.map((project) => (
              <option key={project.id} value={project.id}>
                {project.name}
              </option>
            ))}
          </select>
          {errors.project_id && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>
      </div>

      <div className="flex flex-wrap -mx-2">
        <div className="w-full md:w-1/2 px-2 mb-4 md:mb-0">
          <label htmlFor="start_date" className="mb-1 block">
            Start Date
          </label>
          <input
            id="start_date"
            type="date"
            {...register("start_date", { required: true })}
            className="p-2 border rounded w-full"
          />
          {errors.start_date && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>

        <div className="w-full md:w-1/2 px-2">
          <label htmlFor="end_date" className="mb-1 block">
            End Date
          </label>
          <input
            id="end_date"
            type="date"
            {...register("end_date", { required: true })}
            className="p-2 border rounded w-full"
          />
          {errors.end_date && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>
      </div>

      <div className="flex flex-wrap -mx-2">
        <div className="w-full md:w-1/2 px-2 mb-4 md:mb-0">
          <label htmlFor="assigned_to" className="mb-1 block">
            Assign To
          </label>
          <select
            id="assigned_to"
            {...register("assigned_to", { required: true })}
            className="p-2 border rounded w-full"
          >
            {users.map((user) => (
              <option key={user.id} value={user.id}>
                {user.name}
              </option>
            ))}
          </select>
          {errors.assigned_to && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>

        <div className="w-full md:w-1/2 px-2">
          <label htmlFor="department" className="mb-1 block">
            Department
          </label>
          <select
            id="department"
            {...register("department", { required: true })}
            className="p-2 border rounded w-full"
          >
            {departments.map((department) => (
              <option key={department.id} value={department.name}>
                {department.name}
              </option>
            ))}
          </select>
          {errors.department && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>
      </div>

      <div className="flex flex-wrap -mx-2">
        <div className="w-full px-2 mb-4">
          <label htmlFor="description" className="mb-1 block">
            Description
          </label>
          <textarea
            id="description"
            {...register("description")}
            className="p-2 border rounded w-full"
          />
        </div>
      </div>

      <div className="flex flex-wrap -mx-2">
        <div className="w-full md:w-1/2 px-2 mb-4 md:mb-0">
          <label htmlFor="status" className="mb-1 block">
            Status
          </label>
          <select
            id="status"
            {...register("status", { required: true })}
            className="p-2 border rounded w-full"
          >
            <option value="Not Started">Not Started</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
          </select>
          {errors.status && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>

        <div className="w-full md:w-1/2 px-2">
          <label htmlFor="due_date" className="mb-1 block">
            Due Date
          </label>
          <input
            id="due_date"
            type="date"
            {...register("due_date", { required: true })}
            className="p-2 border rounded w-full"
          />
          {errors.due_date && (
            <span className="text-red-500">This field is required</span>
          )}
        </div>
      </div>

      <button
        type="submit"
        className="w-full bg-blue-500 text-white p-2 rounded"
      >
        Create Task
      </button>
    </form>
  );
};

export default TaskForm;
