import tkinter as tk
import time
import sqlite3
from tkinter import messagebox

# based on
# https://www.w3resource.com/python-exercises/tkinter/python-tkinter-file-operations-and-integration-exercise-12.php


class CRUDApp:
    def __init__(self, root):
        self.root = root
        self.root.title("CRUD Prompts Application")
        self.root.geometry("500x500")  # You want the size of the app to be 500x500
        self.root.resizable(1, 1)  # Don't allow resizing in the x or y direction

        # Create a database or connect to an existing one
        self.conn = sqlite3.connect("prompts.db")
        self.cursor = self.conn.cursor()

        # Create a table if it doesn't exist
        self.cursor.execute('''CREATE TABLE IF NOT EXISTS prompts (
            id INTEGER PRIMARY KEY,
            name TEXT,
            prompt VARCHAR(6000),
            type TEXT,
            score REAL,
            created_date datetime default current_timestamp
        )''')
        self.conn.commit()

        # Create GUI elements
        entry_text = tk.StringVar()
        self.name_label = tk.Label(root, text="Name:")
        self.name_label.pack()
        self.name_entry = tk.Entry(root, width=50, textvariable=entry_text)
        new_text = "pre"
        entry_text.set(new_text)
        self.name_entry.pack()

        self.prompt_label = tk.Label(root, text="Prompt:")
        self.prompt_label.pack()
        #self.prompt_entry = tk.Text(root, height=10, width=50)
        self.prompt_entry = tk.Entry(root, width=50)
        self.prompt_entry.pack()

        self.type_label = tk.Label(root, text="Type:")
        self.type_label.pack()
        self.type_entry = tk.Entry(root, width=5)
        self.type_entry.pack()

        self.score_label = tk.Label(root, text="Score:")
        self.score_label.pack()
        self.score_entry = tk.Entry(root, width=5)
        self.score_entry.pack()

        self.add_button = tk.Button(root, text="Add Prompt", command=self.add_prompt)
        self.add_button.pack()
        self.prompt_listbox = tk.Listbox(root, width=50)
        self.prompt_listbox.pack()

        self.load_prompts()
        #self.update_button = tk.Button(root, text="Update", command=self.update_prompt)
        #self.update_button.pack()
        #self.delete_button = tk.Button(root, text="Delete", command=self.delete_prompt)
        #self.delete_button.pack()

    def add_prompt(self):
        name = self.name_entry.get()
        prompt = self.prompt_entry.get()
        type = self.type_entry.get()
        score = self.score_entry.get()
        created_date = time.strftime('%Y-%m-%d %H:%M:%S')

        name = "pre"
        type = 1
        score = 1

        if name and score and prompt:
            # self.cursor.execute("INSERT INTO students (name, class, marks) VALUES (?, ?, ?)", (name, class, marks))
            self.cursor.execute("INSERT INTO prompts (name, prompt, type, score, created_date) VALUES (?, ?, ?, ?, ?)",
                                (name, prompt, type, score, created_date))
            self.conn.commit()
            self.load_prompts()
            self.clear_entries()
        else:
            messagebox.showwarning("Warning", "Please fill in all fields.")

    def load_prompts(self):
        self.prompt_listbox.delete(0, tk.END)
        self.cursor.execute("SELECT * FROM prompts ORDER BY id DESC LIMIT 3;")
        prompts = self.cursor.fetchall()
        for row in prompts:
            self.prompt_listbox.insert(tk.END, f"{row[0]}. {row[1]}, {row[2]}, {'%.2f' % float(row[3])}")

    def clear_entries(self):
        self.name_entry.delete(0, tk.END)
        self.prompt_entry.delete(0, tk.END)
        self.type_entry.delete(0, tk.END)
        self.score_entry.delete(0, tk.END)

    def update_prompt(self):
        selected_prompt = self.prompt_listbox.get(tk.ACTIVE)
        if selected_prompt:
            prompt_id = int(selected_prompt.split(".")[0])
            name = self.name_entry.get()
            prompt = self.prompt_entry.get()
            type = self.type_entry.get()
            score = self.score_entry.get()
            if name and prompt:
                self.cursor.execute("UPDATE prompts SET name=?, prompt=?, type=?, score=? WHERE id=?",
                                    (name, prompt, type, score, prompt_id))
                self.conn.commit()
                self.load_prompts()
                self.clear_entries()
            else:
                messagebox.showwarning("Warning", "Please fill in all fields.")
        else:
            messagebox.showwarning("Warning", "Please select an prompt to update.")

    def delete_prompt(self):
        selected_prompt = self.prompt_listbox.get(tk.ACTIVE)
        if selected_prompt:
            prompt_id = int(selected_prompt.split(".")[0])
            self.cursor.execute("DELETE FROM prompts WHERE id=?", (prompt_id,))
            self.conn.commit()
            self.load_prompts()
            self.clear_entries()
        else:
            messagebox.showwarning("Warning", "Please select an prompt to delete.")

    def __del__(self):
        self.conn.close()


if __name__ == "__main__":
    root = tk.Tk()
    app = CRUDApp(root)
    root.mainloop()
