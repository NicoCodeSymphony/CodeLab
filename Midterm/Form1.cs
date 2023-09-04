using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            RefreshForm();
        }

        public List<string> GetUniqueNames()
        {

            HashSet<string> uniqueNames = new HashSet<string>();


            foreach (DataGridViewRow row in dataGridView1.Rows)
            {

                DataGridViewCell nameCell = row.Cells[5];
                if (nameCell != null && nameCell.Value != null)
                {
                    string name = nameCell.Value.ToString();


                    if (!uniqueNames.Contains(name))
                    {
                        uniqueNames.Add(name);
                    }
                }
            }
            return uniqueNames.ToList();
        }

        public void selectedItem()
        {
            foreach (DataGridViewRow row in dataGridView1.Rows)
                if (row.Cells[1].Value != null && row.Cells[1].Value.ToString().Equals(textBox1.Text))
                {
                    if (dataGridView1.SelectedRows.Count > 0)
                    {
                        dataGridView1.ClearSelection();
                    }
                    row.Selected = true;
                    dataGridView1.FirstDisplayedScrollingRowIndex = row.Index;
                    break;
                }
        }

        public void RefreshForm()
        {
            SqlConnection con = new SqlConnection("Data Source=CCS-PC032\\SQLEXPRESS;Initial Catalog=Products;Integrated Security=True;Connect Timeout=30;Encrypt=False;TrustServerCertificate=False;ApplicationIntent=ReadWrite;MultiSubnetFailover=False");
            con.Open();
            SqlCommand cmd = new SqlCommand("select * from products ORDER BY ID DESC", con);
            SqlDataAdapter da = new SqlDataAdapter(cmd);
            DataTable dt = new DataTable();
            da.Fill(dt);
            dataGridView1.DataSource = dt;
            selectedItem();
        }

        private void header_TextChanged(object sender, EventArgs e)
        {
           
        }

        private void Add_Click(object sender, EventArgs e)
        {
            Form2 f2 = new Form2(dataGridView1);
            f2.label7.Text = "Fill in the Blanks to Add Data";
            f2.counter = 1;
            f2.Show();

            
            f2.Show();
        }

        private void Update_Click(object sender, EventArgs e)
        {
            DataGridViewRow row = dataGridView1.SelectedRows[0];
            string column1Value = row.Cells[1].Value.ToString();
            string column2Value = row.Cells[2].Value.ToString();
            string column3Value = row.Cells[3].Value.ToString();
            string column4Value = row.Cells[4].Value.ToString();
            string column6Value = row.Cells[5].Value.ToString();
            string column5Value = row.Cells[0].Value.ToString();
            Form2 f2 = new Form2(dataGridView1);
            f2.textBox1.Text = column1Value;
            f2.textBox2.Text = column2Value;
            f2.textBox3.Text = column3Value;
            f2.textBox4.Text = column4Value;
            f2.textBox5.Text = column5Value;
            f2.textBox6.Text = column6Value;
            f2.counter = 2;
            f2.label7.Text = "Edit Data to Update";
            /*f2.SaveData += OtherForm_SaveData;*/
            f2.Show();
        }

        private void Delete_Click(object sender, EventArgs e)
        {
            SqlConnection con = new SqlConnection("Data Source=CCS-PC032\\SQLEXPRESS;Initial Catalog=Products;Integrated Security=True;Connect Timeout=30;Encrypt=False;TrustServerCertificate=False;ApplicationIntent=ReadWrite;MultiSubnetFailover=False");

            if (DialogResult.Yes == MessageBox.Show("Are you sure you want to delete this record ?", "Confirmation", MessageBoxButtons.YesNo, MessageBoxIcon.Warning))
            {
                con.Open();
                SqlCommand cmd = new SqlCommand("Delete products where ID=@ID", con);
                cmd.Parameters.AddWithValue("@Name", textBox1.Text);
                cmd.Parameters.AddWithValue("@ID", textBox2.Text);
                cmd.ExecuteNonQuery();
            }
            RefreshForm();
        }

        private void Search_Click(object sender, EventArgs e)
        {
            /*selectedItem();*/
            dataGridView1.DataSource = null;
            dataGridView1.Refresh();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
           
        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            dataGridView1.CurrentRow.Selected = true;
            textBox1.Text = dataGridView1.Rows[e.RowIndex].Cells["Name"].Value.ToString();
            textBox2.Text = dataGridView1.Rows[e.RowIndex].Cells["ID"].Value.ToString();
        }

        private void label2_Click(object sender, EventArgs e)
        {
            DataGridViewRow row = dataGridView1.SelectedRows[0];
            string column1Value = row.Cells[1].Value.ToString();
            string column3Value = row.Cells[3].Value.ToString();
            Form3 f3 = new Form3(dataGridView1);
            f3.label3.Text = column1Value;
            f3.textBox2.Text = column3Value;
            f3.Show();
           
        }
    }
}
