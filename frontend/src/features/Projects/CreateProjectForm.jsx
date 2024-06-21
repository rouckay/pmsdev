import { useForm, useFieldArray } from "react-hook-form";
import Button from "../../components/Button";
import toast from "react-hot-toast";

const CreateProjectForm = () => {
  const {
    register,
    handleSubmit,
    control,
    formState: { errors },
    reset,
  } = useForm();

  const { fields, append, remove } = useFieldArray({
    control,
    name: "resources",
  });

  const onSubmit = (data) => {
    toast.success("Project created successfully");
    console.log(data);
    reset();
  };

  return (
    <div className="flex justify-center items-center min-h-screen ">
      <div className="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <form onSubmit={handleSubmit(onSubmit)} className="space-y-4 text-sm">
          <div>
            <label htmlFor="name" className="block mb-1 font-medium">
              Name
            </label>
            <input
              id="name"
              className="w-full p-2 border rounded"
              {...register("name", { required: true })}
            />
            {errors.name && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>

          <div>
            <label htmlFor="start_date" className="block mb-1 font-medium">
              Start Date
            </label>
            <input
              id="start_date"
              type="date"
              className="w-full p-2 border rounded"
              {...register("start_date", { required: true })}
            />
            {errors.start_date && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>

          <div>
            <label htmlFor="end_date" className="block mb-1 font-medium">
              End Date
            </label>
            <input
              id="end_date"
              type="date"
              className="w-full p-2 border rounded"
              {...register("end_date", { required: true })}
            />
            {errors.end_date && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>

          <div>
            <label htmlFor="department" className="block mb-1 font-medium">
              Department
            </label>
            <select
              id="department"
              className="w-full p-2 border rounded"
              {...register("department", { required: true })}
            >
              <option value="Web">Web Development</option>
              <option value="AI">Artificial Intelligence</option>
              <option value="IT">IT</option>
            </select>
            {errors.department && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>

          <div>
            <label htmlFor="description" className="block mb-1 font-medium">
              Description
            </label>
            <textarea
              id="description"
              className="w-full p-2 border rounded"
              {...register("description", { required: true })}
            />
            {errors.description && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>

          <div>
            <label htmlFor="status" className="block mb-1 font-medium">
              Status
            </label>
            <select
              id="status"
              className="w-full p-2 border rounded"
              {...register("status", { required: true })}
            >
              <option value="Active">Active</option>
              <option value="Paused">Paused</option>
              <option value="Inactive">Inactive</option>
            </select>
            {errors.status && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>

          <div>
            <label className="block mb-1 font-medium">Resources</label>
            {fields.map((item, index) => (
              <div key={item.id} className="flex items-center space-x-2 mb-2">
                <input
                  type="text"
                  placeholder="Resource Name"
                  {...register(`resources.${index}.name`, { required: true })}
                  className="p-2 border rounded flex-1"
                />
                <input
                  type="number"
                  placeholder="Quantity"
                  {...register(`resources.${index}.quantity`, {
                    required: true,
                    min: 1,
                  })}
                  className="p-2 border rounded w-20"
                />
                <button
                  type="button"
                  onClick={() => remove(index)}
                  className="p-2 bg-red-500 text-white rounded"
                >
                  Remove
                </button>
              </div>
            ))}
            <Button
              type="button"
              onClick={() => append({ name: "", quantity: 1 })}
              className="mt-2 p-2 bg-blue-500 text-white rounded"
            >
              Add Resource
            </Button>
          </div>

          <Button
            type="submit"
            className="w-full p-2 bg-green-500 text-white rounded"
          >
            Add Project
          </Button>
        </form>
      </div>
    </div>
  );
};

export default CreateProjectForm;
