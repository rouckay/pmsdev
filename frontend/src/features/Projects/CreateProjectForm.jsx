import { useForm, useFieldArray } from "react-hook-form";
import toast from "react-hot-toast";
import { HiMiniPlusCircle, HiMiniTrash, HiXMark } from "react-icons/hi2";

const CreateProjectForm = ({ onClose }) => {
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
    <div className="flex justify-center items-center p-4 text-sm">
      <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
        <div className="grid grid-cols-2 gap-4">
          <div className="flex flex-col">
            <label htmlFor="name" className="font-medium">
              Name
            </label>
            <input
              id="name"
              className="p-2 border rounded"
              {...register("name", { required: true })}
            />
            {errors.name && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>
          <div className="flex flex-col">
            <label htmlFor="department" className="font-medium">
              Department
            </label>
            <select
              id="department"
              className="p-2 border rounded"
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
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div className="flex flex-col">
            <label htmlFor="start_date" className="font-medium">
              Start Date
            </label>
            <input
              id="start_date"
              type="date"
              className="p-2 border rounded"
              {...register("start_date", { required: true })}
            />
            {errors.start_date && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>
          <div className="flex flex-col">
            <label htmlFor="end_date" className="font-medium">
              End Date
            </label>
            <input
              id="end_date"
              type="date"
              className="p-2 border rounded"
              {...register("end_date", { required: true })}
            />
            {errors.end_date && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>
        </div>

        <div className="grid grid-cols-2 gap-4">
          <div className="flex flex-col">
            <label htmlFor="description" className="font-medium">
              Description
            </label>
            <textarea
              id="description"
              className="p-2 border rounded"
              {...register("description", { required: true })}
            />
            {errors.description && (
              <span className="text-red-500">This field is required</span>
            )}
          </div>
          <div className="flex flex-col">
            <label htmlFor="status" className="font-medium">
              Status
            </label>
            <select
              id="status"
              className="p-2 border rounded"
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
        </div>

        <div className="flex flex-col mb-4">
          <label className="font-medium">Resources</label>
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
                className="p-1 bg-red-500 text-white rounded"
              >
                <HiMiniTrash className="h-5 w-5" />
              </button>
            </div>
          ))}
          <div>
            <button
              type="button"
              onClick={() => append({ name: "", quantity: 1 })}
              className="mt-2 p-2 rounded-full"
            >
              <HiMiniPlusCircle className="h-8 w-8 text-blue-500 -translate-y-3 rounded-full" />
            </button>
          </div>
        </div>

        <button
          type="submit"
          className="w-full p-2 bg-blue-500 text-white rounded"
        >
          Add Project
        </button>
      </form>
    </div>
  );
};

export default CreateProjectForm;
