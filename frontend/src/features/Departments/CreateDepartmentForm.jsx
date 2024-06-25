import { useForm } from "react-hook-form";
import { HiXMark } from "react-icons/hi2";

const CreateDepartmentForm = ({ onClose }) => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const onSubmit = (data) => {
    console.log(data);
  };

  return (
    <div className="flex justify-center items-center p-8 bg-gray-100">
      <div className="relative bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        {/* <button
          onClick={onClose}
          className="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
        >
          <HiXMark className="h-5 w-5" />
        </button> */}

        <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block mb-1">Name</label>
              <input
                {...register("name", { required: "Name is required" })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.name && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.name.message}
                </p>
              )}
            </div>
            <div>
              <label className="block mb-1">Description</label>
              <input
                {...register("description", {
                  required: "Description is required",
                })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.description && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.description.message}
                </p>
              )}
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block mb-1">Company Name</label>
              <input
                type="text"
                {...register("company_name", {
                  required: "Company name is required",
                })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.company_id && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.company_name.message}
                </p>
              )}
            </div>
            <div>
              <label className="block mb-1">Status</label>
              <select
                {...register("active")}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              >
                <option value="true">Active</option>
                <option value="false">Inactive</option>
              </select>
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
          <button
            type="submit"
            className="w-full bg-blue-500 text-white py-2 rounded-md"
          >
            Add department
          </button>
        </form>
      </div>
    </div>
  );
};

export default CreateDepartmentForm;
