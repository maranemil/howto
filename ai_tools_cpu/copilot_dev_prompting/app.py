import tkinter as tk
from database import insert_data

def submit_form():
    #name = entry_name.get()
    name = entry_name.get("1.0", tk.END)  # Get text  
    email = entry_email.get()
    insert_data(name, email)
    entry_name.delete(0, tk.END)
    entry_email.delete(0, tk.END)

root = tk.Tk()
root.title("Simple Form")

# setting the windows size
root.geometry("600x400")



tk.Label(root, text="Name").pack()
#entry_name = tk.Entry(root, width=60)
##entry.insert(INSERT, "Enter Your Name")
#entry_name.pack(ipadx= 3, ipady=3)
# Create a Text widget (textarea)
entry_name = tk.Text(root, wrap=tk.WORD, font=("Arial", 12), height=10, width=40)
entry_name.pack(pady=10, padx=10)

#tk.Label(root, text="Name",width=60, bg="blue", fg="white").pack(pady=1, padx=1)
#entry_name = tk.Entry(root,width=60)
#entry_name.pack()

tk.Label(root, text="Email").pack()
entry_email = tk.Entry(root)
entry_email.pack()

tk.Button(root, text="Submit", command=submit_form).pack()

root.mainloop()