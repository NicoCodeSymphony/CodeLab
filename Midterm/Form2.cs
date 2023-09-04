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
    public partial class Form2 : Form
    {
        SqlConnection con = new SqlConnection("Data Source=CCS-PC032\\SQLEXPRESS;Initial Catalog=Products;Integrated Security=True;Connect Timeout=30;Encrypt=False;TrustServerCertificate=False;ApplicationIntent=ReadWrite;MultiSubnetFailover=False");
        public int counter;
        public int rowIndex;
        private DataGridView _dtg;
        public Form2()
        {
            InitializeComponent();
        }

        public Form2(DataGridView dtg) : this()
        {
            _dtg = dtg;
        }
        private void Form2_Load(object sender, EventArgs e)
        {
            Form1 form1 = new Form1();
            /*List<string> data = form1.GetDataGridViewData();
            comboBox1.Items.AddRange(data.ToArray());
            comboBox1.Text = form1.dataGridView1.CurrentRow.Cells[5].Value.ToString();
            Form1 form1 = new Form1();*/
            /*List<string> data = form1.GetDataGridViewData();
            comboBox1.Items.AddRange(data.ToArray());*/

            List<string> uniqueNames = form1.GetUniqueNames();

            foreach (string name in uniqueNames) { comboBox1.Items.Add(name); }
            comboBox1.Text = textBox6.Text;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            int number;
            if (counter == 2)
            {
                con.Open();
                SqlCommand cmd = new SqlCommand("UPDATE products set Name=@Name, Price=@Price, Stocks=@Stocks, Units=@Units, Category=@Category where ID=@ID", con);
                cmd.Parameters.AddWithValue("@Name", textBox1.Text);
                cmd.Parameters.AddWithValue("@Price", textBox2.Text);
                cmd.Parameters.AddWithValue("@Stocks", textBox3.Text);
                cmd.Parameters.AddWithValue("@Units", textBox4.Text);
                cmd.Parameters.AddWithValue("@ID", textBox5.Text);
                cmd.Parameters.AddWithValue("@Category", comboBox1.Text);
                cmd.ExecuteNonQuery();
                MessageBox.Show("Update Successfully");

                SqlCommand cmd2 = new SqlCommand("select * from products ORDER BY ID DESC", con);
                SqlDataAdapter da = new SqlDataAdapter(cmd2);
                DataTable dt = new DataTable();
                da.Fill(dt);
                _dtg.DataSource = dt;
                this.Close();
            }



            if (counter == 1)
            {

                if (textBox1.Text == "" || textBox2.Text == "" || textBox3.Text == "" || textBox4.Text == "")
                {
                    MessageBox.Show("The textbox is empty\nPlease fill in the blanks", "Error");
                }


                else
                {
                    if (!int.TryParse(textBox2.Text, out number) || !int.TryParse(textBox3.Text, out number))
                    {
                        MessageBox.Show("This textbox contain some string values\nIt must be an integer value only", "Error");
                    }
                    else
                    {
                        con.Open();
                        SqlCommand cmd = new SqlCommand("insert into products values(@Name, @Price, @Stocks, @Units, @Category)", con);
                        cmd.Parameters.AddWithValue("@Name", textBox1.Text);
                        cmd.Parameters.AddWithValue("@Price", textBox2.Text);
                        cmd.Parameters.AddWithValue("@Stocks", textBox3.Text);
                        cmd.Parameters.AddWithValue("@Units", textBox4.Text);
                        cmd.Parameters.AddWithValue("@Category", comboBox1.Text);

                        cmd.ExecuteNonQuery();
                        MessageBox.Show("Added Succesfully");

                        SqlCommand cmd2 = new SqlCommand("select * from products ORDER BY ID DESC", con);
                        SqlDataAdapter da = new SqlDataAdapter(cmd2);
                        DataTable dt = new DataTable();
                        da.Fill(dt);
                        _dtg.DataSource = dt;

                        this.Close();
                    }

                }


            }
        }

        private void Form2_Load_1(object sender, EventArgs e)
        {
            Form1 form1 = new Form1();
            List<string> uniqueNames = form1.GetUniqueNames();

            foreach (string name in uniqueNames) { comboBox1.Items.Add(name); }
            comboBox1.Text = textBox6.Text;
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {

        }
    }
}
