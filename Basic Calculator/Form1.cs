using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.ProgressBar;

namespace Basic_Calculator
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        float num, result;
        int counter, click;
        string from_textbox;

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void btn1_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }

            textBox1.Text = textBox1.Text + 1;
        }

        private void btn2_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 2;
        }

        private void btn3_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 3;
        }

        private void btn4_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 4;
        }

        private void btn5_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 5;
        }

        private void btn6_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 6;
        }

        private void btn7_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 7;
        }

        private void btn8_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 8;

        }

        private void btn9_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 9;
        }

        private void btn0_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "0") { textBox1.Clear(); }
            else if (click == 1) { textBox1.Clear(); click = 0; }
            textBox1.Text = textBox1.Text + 0;
        }

        private void plus_Click(object sender, EventArgs e)
        {
            from_textbox = textBox1.Text;
            num = float.Parse(textBox1.Text);
            textBox1.Text = "0";
            textBox1.Focus();
            label1.Text = num + " + ";
            counter = 2;
            click = 0;
        }

        private void minus_Click(object sender, EventArgs e)
        {
            if (textBox1.Text != "")
            {
                from_textbox = textBox1.Text;
                label1.Text = from_textbox + " - ";
                num = float.Parse(textBox1.Text);
                textBox1.Text = "0";
                textBox1.Focus();
                counter = 1;
                click = 0;
            }
        }

        private void multiply_Click(object sender, EventArgs e)
        {
            from_textbox = textBox1.Text;
            label1.Text = from_textbox + " * ";
            num = float.Parse(textBox1.Text);
            textBox1.Text = "0";
            textBox1.Focus();
            counter = 3;
            click = 0;

        }

        private void divide_Click(object sender, EventArgs e)
        {
            from_textbox = textBox1.Text;
            label1.Text = from_textbox + " / ";
            num = float.Parse(textBox1.Text);
            textBox1.Text = "0";
            textBox1.Focus();
            counter = 4;
            click = 0;
        }

        private void plusMinus_Click(object sender, EventArgs e)
        {
            if (textBox1.Text.StartsWith("-"))
            {
                textBox1.Text = textBox1.Text.Substring(1);
                from_textbox = textBox1.Text;
                click = 0;
            }

            else if (!string.IsNullOrEmpty(textBox1.Text) && decimal.Parse(textBox1.Text) != 0)
            {
                textBox1.Text = "-" + textBox1.Text;
                from_textbox = textBox1.Text;
                click = 0;
            }
        }



        private void btnDecimal_Click(object sender, EventArgs e)
        {
            int c = textBox1.TextLength;
            int flag = 0;
            string text = textBox1.Text;
            for (int i = 0; i < c; i++)
            {
                if (text[i].ToString() == ".")
                {
                    flag = 1; break;
                }
                else
                {
                    flag = 0;
                }
            }
            if (flag == 0)
            {
                textBox1.Text = textBox1.Text + ".";
            }

            click = 0;
        }


        private void equal_Click(object sender, EventArgs e)
        {
            if(click == 1)
            {
                textBox1.Text = result.ToString();
            }
            else
            {
                calculate(counter);
                label1.Text = "";
                click = 1;
            }
        }

        public void calculate(int counter)
        {
            switch (counter)
            {
                case 1:
                    result = num - float.Parse(textBox1.Text);
                    textBox1.Text = result.ToString();
                    break;
                case 2:
                    result = num + float.Parse(textBox1.Text);
                    textBox1.Text = result.ToString();
                    break;
                case 3:
                    result = num * float.Parse(textBox1.Text);
                    textBox1.Text = result.ToString();
                    break;
                case 4:
                    result = num / float.Parse(textBox1.Text);
                    textBox1.Text = result.ToString();
                    break;
                default:
                    break;
            }


        }

        private void BackSpace_Click(object sender, EventArgs e)
        {
            if (textBox1.Text != string.Empty)
            {
                int textlength = textBox1.Text.Length;
                if (textlength != 1)
                {
                    textBox1.Text = textBox1.Text.Remove(textlength - 1);

                }
                else
                {
                    textBox1.Text = 0.ToString();
                }
            }
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {

        }

        private void textBox2_TextChanged_1(object sender, EventArgs e)
        {

        }

        private void C_Click(object sender, EventArgs e)
        {
            textBox1.Clear();
            textBox1.Text = "0";
            label1.Text = "";
            counter = 0;
        }

    }
}