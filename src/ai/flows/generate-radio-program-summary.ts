'use server';

/**
 * @fileOverview AI-powered tool to automatically generate short summaries for radio programs.
 *
 * - generateRadioProgramSummary - A function that handles the generation of radio program summaries.
 * - GenerateRadioProgramSummaryInput - The input type for the generateRadioProgramSummary function.
 * - GenerateRadioProgramSummaryOutput - The return type for the generateRadioProgramSummary function.
 */

import {ai} from '@/ai/ai-instance';
import {z} from 'genkit';

const GenerateRadioProgramSummaryInputSchema = z.object({
  programTitle: z.string().describe('The title of the radio program.'),
  programDescription: z.string().describe('A detailed description of the radio program.'),
  targetAudience: z.string().describe('The target audience for the radio program.'),
  programCategory: z.string().describe('The category of the radio program (e.g., news, music, talk).'),
});
export type GenerateRadioProgramSummaryInput = z.infer<typeof GenerateRadioProgramSummaryInputSchema>;

const GenerateRadioProgramSummaryOutputSchema = z.object({
  summary: z.string().describe('A concise summary of the radio program.'),
  keywords: z.string().describe('Relevant keywords for the radio program.'),
});
export type GenerateRadioProgramSummaryOutput = z.infer<typeof GenerateRadioProgramSummaryOutputSchema>;

export async function generateRadioProgramSummary(input: GenerateRadioProgramSummaryInput): Promise<GenerateRadioProgramSummaryOutput> {
  return generateRadioProgramSummaryFlow(input);
}

const prompt = ai.definePrompt({
  name: 'generateRadioProgramSummaryPrompt',
  input: {
    schema: z.object({
      programTitle: z.string().describe('The title of the radio program.'),
      programDescription: z.string().describe('A detailed description of the radio program.'),
      targetAudience: z.string().describe('The target audience for the radio program.'),
      programCategory: z.string().describe('The category of the radio program (e.g., news, music, talk).'),
    }),
  },
  output: {
    schema: z.object({
      summary: z.string().describe('A concise summary of the radio program.'),
      keywords: z.string().describe('Relevant keywords for the radio program.'),
    }),
  },
  prompt: `You are an AI assistant helping radio content creators generate engaging descriptions for their programs.

  Based on the following information, create a concise summary and a list of keywords for the radio program:

  Program Title: {{{programTitle}}}
  Program Description: {{{programDescription}}}
  Target Audience: {{{targetAudience}}}
  Program Category: {{{programCategory}}}

  Summary:
  Keywords:`, 
});

const generateRadioProgramSummaryFlow = ai.defineFlow<
  typeof GenerateRadioProgramSummaryInputSchema,
  typeof GenerateRadioProgramSummaryOutputSchema
>({
  name: 'generateRadioProgramSummaryFlow',
  inputSchema: GenerateRadioProgramSummaryInputSchema,
  outputSchema: GenerateRadioProgramSummaryOutputSchema,
}, async input => {
  const {output} = await prompt(input);
  return output!;
});
