import { useForm } from "react-hook-form";
import { HiXMark } from "react-icons/hi2";

const UserForm = ({ onClose }) => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const onSubmit = (data) => {
    console.log(data);
  };

  return (
    <div className="flex justify-center items-center p-8 bg-gray-100 text-sm">
      <div className="relative bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <button
          onClick={onClose}
          className="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
        >
          <HiXMark className="h-5 w-5" />
        </button>
        <h2 className="text-2xl font-bold mb-5 text-center">User Form</h2>
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
              <label className="block mb-1">Username</label>
              <input
                {...register("user_name", { required: "Username is required" })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.user_name && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.user_name.message}
                </p>
              )}
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block mb-1">Email</label>
              <input
                {...register("email", { required: "Email is required" })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.email && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.email.message}
                </p>
              )}
            </div>
            <div>
              <label className="block mb-1">Password</label>
              <input
                type="password"
                {...register("password", { required: "Password is required" })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.password && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.password.message}
                </p>
              )}
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block mb-1">Phone Number</label>
              <input
                {...register("phone_number", {
                  required: "Phone Number is required",
                })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.phone_number && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.phone_number.message}
                </p>
              )}
            </div>
            <div>
              <label className="block mb-1">Address</label>
              <input
                {...register("address", { required: "Address is required" })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
              {errors.address && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.address.message}
                </p>
              )}
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block mb-1">Type</label>
              <select
                {...register("type", { required: "Type is required" })}
                className="w-full px-3 py-2 border border-gray-300 rounded-md"
              >
                <option value="user">Super Admin</option>
                <option value="admin">Admin</option>
                <option value="admin">Manager</option>
                <option value="admin">User</option>
              </select>
              {errors.type && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.type.message}
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
          <button
            type="submit"
            className="w-full bg-blue-500 text-white py-2 rounded-md"
          >
            Submit
          </button>
        </form>
      </div>
    </div>
  );
};

export default UserForm;
