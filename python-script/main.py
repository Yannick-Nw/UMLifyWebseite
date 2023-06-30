import os
import re
import json
import sys


def remove_unnecessary_content(content):
    single_line_comment_pattern = r'//.*$'
    multi_line_comment_pattern = r'/\*.*\*/'
    preprocessor_pattern = r'#.*$'
    content = re.sub(single_line_comment_pattern,
                     '', content, flags=re.MULTILINE)
    content = re.sub(multi_line_comment_pattern, '', content, flags=re.DOTALL)
    content = re.sub(preprocessor_pattern, '', content, flags=re.MULTILINE)
    content = content.replace("\n", "")
    return content


def get_variable_content(variable):
    if variable[0]:
        return f"{variable[0]} {variable[2]}", variable[3], variable[4]
    elif variable[1]:
        return f"{variable[1]} {variable[2]}", variable[3], variable[4]
    elif len(variable) == 6:
        return variable[2], variable[3], variable[4], variable[5]
    else:
        return variable[2], variable[3], variable[4]


def content2dict(content, class_data):
    data_types = r"\b(char|short|string|int|long|float|double|bool|void|enum|struct|union|class)\b"
    content = remove_unnecessary_content(content)
    class_regex = r"class\s+(\w+)\s*?(?:\:\s*\s*(?:public|private|protected)\s+(\w+)\s*,?)*\s*(\{[^{}]*\});?"
    classes = re.findall(class_regex, content)
    print(classes)
    for class_match in classes:
        # Check if the class is just there to tell the programm this class exits
        inner = class_match[2]
        if inner == "{}":
            continue
        # ------------- Class Names ---------------- #
        class_name = class_match[0]
        class_data["classes"][class_name] = dict()
        # ----------- Parent ------------- #
        # If there is no parent -> parent: ""
        class_data["classes"][class_name]["parent"] = class_match[1]

        # -------------- Inner Class Part -------------- #
        variable = r"(?:const\s+|(enum)\s+|(struct)\s+)?(?:\w+::)?(\w+|\w+<\w+(?:\*|&)*>)(?:\*|&)*\s+((?:\*|&)+\s*)*(\w+)\s*(?:\[(?:\s*\d+\s*)?\])?\s*"

        inner_stdl_content = r"\w+<(\w+)(?:\*|&)*>"
        # These regex expressions describe the whole part after e.g private: until } or protected: or public:
        access_modifiers = [(r"(.*?)(?:protected:|public:|private:|\})", "-"),
                            (r"private:(.*?)(?:protected:|public:|\})", "-"),
                            (r"public:(.*?)(?:private:|protected:|\})", "+"),
                            (r"protected:(.*?)(?:private:|public:|\})", "#")]
        class_data["classes"][class_name]["attributes"] = list()
        class_data["classes"][class_name]["methods"] = list()
        for pattern, symbol in access_modifiers:
            inner_access = re.findall(pattern, inner)
            if len(inner_access) > 0:
                inner_access = inner_access[0]
                # ---------------- Attributes ---------------------- #
                attribute_pattern = f"{variable};"
                attribute_matches = re.findall(attribute_pattern, inner_access)
                for attribute_match in attribute_matches:
                    data_type, pointer, name = get_variable_content(
                        attribute_match)
                    inner_stdl_datatype = re.findall(inner_stdl_content, data_type)
                    if inner_stdl_datatype:
                        if not re.findall(data_types, data_type):
                            class_data["relations"].add((class_name, inner_stdl_datatype[0]))
                    elif not re.findall(data_types, data_type):
                        class_data["relations"].add((class_name, data_type))
                    class_data["classes"][class_name]["attributes"].append(
                        f"{symbol}{data_type} : {pointer}{name}")


                # -------- Methods ----------------#
                method_regex = fr"{variable}\s*\((.*?)(?:\);|\)\s*=\s*0;|\s*override\s*;)"
                method_matches = re.findall(method_regex, inner_access)
                for method_match in method_matches:
                    data_type, pointer, name, parameters = get_variable_content(
                        method_match)
                    parameters = re.findall(variable, parameters)
                    method = dict()
                    inner_stdl_datatype = re.findall(inner_stdl_content, data_type)
                    if inner_stdl_datatype:
                        if not re.findall(data_types, data_type):
                            class_data["relations"].add((class_name, inner_stdl_datatype[0]))
                    elif not re.findall(data_types, data_type):
                        class_data["relations"].add((class_name, data_type))
                    method["name"] = f"{symbol}{name} : {pointer}{data_type}"
                    method["parameters"] = list()
                    for paramter in parameters:
                        data_type, pointer, name = get_variable_content(
                            paramter)
                        inner_stdl_datatype = re.findall(inner_stdl_content, data_type)
                        if inner_stdl_datatype:
                            if not re.findall(data_types, data_type):
                                class_data["relations"].add((class_name, inner_stdl_datatype[0]))
                        elif not re.findall(data_types, data_type):
                            class_data["relations"].add((class_name, data_type))
                        method["parameters"].append(
                            f"{data_type} : {pointer}{name}")
                    class_data["classes"][class_name]["methods"].append(method)
    return class_data


# temp folder for uploads
if len(sys.argv) == 2:
    folder_name = sys.argv[1]
else:
    print("Bitte geben Sie einen Ordnernamen als Parameter an.")

h_pattern = r'.*\.h$'
class_data = dict()
class_data["relations"] = set()
class_data["classes"] = dict()
for root, dirs, files in os.walk('uploads/' + folder_name):
    for file in files:
        if re.match(h_pattern, file):
            with open(os.path.join(root, file)) as f:
                content = f.read()
            class_data = content2dict(content, class_data)

print(list(class_data["classes"].keys()))
class_data["relations"] = list(class_data["relations"])
class_data["relations"] = [(knows, is_known) for knows, is_known in class_data["relations"]
                           if is_known in class_data["classes"].keys()]

with open('uploads/' + folder_name + "/result.json", 'w') as fp:
    json.dump(class_data, fp)
